<?php

namespace DBTech\Credits\BbCode;

/**
 * Class Charge
 *
 * @package DBTech\Credits\BbCode
 */
class Charge
{
	/**
	 * @param $tagChildren
	 * @param $tagOption
	 * @param $tag
	 * @param array $options
	 * @param \XF\BbCode\Renderer\AbstractRenderer $renderer
	 *
	 * @return string|\XF\Phrase
	 * @throws \XF\PrintableException
	 */
	public static function charge($tagChildren, $tagOption, $tag, array $options, \XF\BbCode\Renderer\AbstractRenderer $renderer)
	{
		if (!isset($options['entity']) || !($options['entity'] instanceof \XF\Entity\Post))
		{
			// This must be outside the Show Thread page, ignore it
			return $renderer->renderSubTree($tag['children'], $options);
		}
		
		/** @var \DBTech\Credits\XF\Entity\User $visitor */
		$visitor = \XF::visitor();
		
		if ($visitor->canBypassDbtechCreditsCharge())
		{
			// This user can bypass charge tags
			return $renderer->renderSubTree($tag['children'], $options);
		}
		
		/** @var \XF\Entity\Post $post */
		$post = $options['entity'];
		
		if (!$post->post_id)
		{
			// Post must not be saved yet
			return $renderer->renderSubTree($tag['children'], $options);
		}

		// Get the container
		$bbCodeContainer = \XF::app()->bbCode();
		$rules = $bbCodeContainer->rules('base');

		// Render the content to prepare for hash checks
		// 	don't include renderer states as we want the rendering to be identical
		// 	to how it works in DiscussionMessage_Post
		$renderedContent = $bbCodeContainer->processor()->renderAst($tagChildren, $rules);
		$contentHash = md5($post->post_id . $renderedContent);

		/** @var \DBTech\Credits\Entity\Charge $charge */
		$charge = \XF::finder('DBTech\Credits:Charge')
			->where('post_id', $post->post_id)
			->where('content_hash', $contentHash)
			->fetchOne()
		;

		// Get the post info
		if (!$charge)
		{
			$charge = \XF::em()->create('DBTech\Credits:Charge');
			$charge->post_id = $post->post_id;
			$charge->content_hash = $contentHash;
			$charge->cost = intval($tagOption);
			$charge->save();
		}

		if (!$visitor->user_id)
		{
			return '
				<span>
					<input type="button" class="button" value="' . \XF::phrase('dbtech_credits_costs_x_y', [
						'param1' => $charge->Currency->getFormattedValue($charge->cost),
						'param2' => $charge->Currency->title
					]) . '" />
				</span>
			';
		}
		else if (
			$post->user_id
			&& $post->user_id != $visitor->user_id
			&& !$charge->Purchases->offsetExists($visitor->user_id)
		)
		{
			return '
				<span>
					<input
						type="button"
						class="button"
						data-xf-click="overlay"
						data-href="' . \XF::app()->router('public')->buildLink('dbtech-credits/currency/buy-content', $charge->Currency, ['post_id' => $charge->post_id, 'content_hash' => $charge->content_hash]) . '"
						value="' . \XF::phrase('dbtech_credits_view_for_x_y', [
							'param1' => $charge->Currency->getFormattedValue($charge->cost),
							'param2' => $charge->Currency->title
						]) . '"
					/>
				</span>
			';
		}

		// If users have paid for this
		return $renderer->renderSubTree($tag['children'], $options);
	}
}