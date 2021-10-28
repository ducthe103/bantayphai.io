<?php
// FROM HASH: e9fbdd1a2cf30104008ea6206d012e42
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<div class="sub-block-container brmsTab" data-xf-init="brms-tab">
	<h3 class="block-formSectionHeader">
		<span class="collapse-button"><i class="far fa-minus-square" aria-hidden="true"></i></span>
		<span class="block-formSectionHeader-aligner tabHeader"></span>
		<div class="displayOrder">' . $__templater->formNumberBox(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][display_order]',
		'value' => $__vars['tab']['display_order'],
		'class' => 'orderValue input--numberNarrow',
	)) . '</div>
	</h3>
	<div class="block-body hideParent">
		';
	$__compilerTemp1 = array(array(
		'value' => '',
		'label' => 'None',
		'_type' => 'option',
	));
	$__compilerTemp1 = $__templater->mergeChoiceOptions($__compilerTemp1, $__vars['listKinds']);
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][kind]',
		'class' => 'autoSize hiddenSelector tabKind',
		'value' => $__templater->filter($__vars['tab']['kind'], array(array('raw', array()),), false),
	), $__compilerTemp1, array(
		'label' => 'Tab Type',
	)) . '
		' . $__templater->formTextBoxRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][title]',
		'value' => $__vars['tab']['title'],
		'placeholder' => 'Title',
		'size' => '20',
	), array(
		'label' => 'Title',
	)) . '
		' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][active]',
		'value' => '1',
		'selected' => $__vars['tab']['active'],
		'label' => 'Active',
		'_type' => 'option',
	)), array(
		'label' => '',
	)) . '
		<div class="tabFields hideParent hiddenContainer hiddenContainer_thread">
			';
	$__compilerTemp2 = array(array(
		'value' => '',
		'label' => 'None',
		'_type' => 'option',
	));
	$__compilerTemp2 = $__templater->mergeChoiceOptions($__compilerTemp2, $__vars['listTypeThreads']);
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][type]',
		'class' => 'autoSize hiddenSelector tabType',
		'value' => $__templater->filter($__vars['tab']['type'], array(array('raw', array()),), false),
	), $__compilerTemp2, array(
		'label' => 'Thread Type',
	)) . '
			<div class="tabFields hiddenContainer hiddenContainer_my_threads hiddenContainer_sticky_threads">
				';
	$__compilerTemp3 = array(array(
		'value' => 'last_post_date',
		'label' => 'Last message',
		'_type' => 'option',
	)
,array(
		'value' => 'post_date',
		'label' => 'First message',
		'_type' => 'option',
	)
,array(
		'value' => 'title',
		'label' => 'Title',
		'_type' => 'option',
	)
,array(
		'value' => 'reply_count',
		'label' => 'Replies',
		'_type' => 'option',
	)
,array(
		'value' => 'view_count',
		'label' => 'Views',
		'_type' => 'option',
	));
	if ($__vars['xf']['options']['currentVersionId'] < 2010000) {
		$__compilerTemp3[] = array(
			'value' => 'first_post_likes',
			'label' => 'first_message_likes',
			'_type' => 'option',
		);
	} else {
		$__compilerTemp3[] = array(
			'value' => 'first_post_reaction_score',
			'label' => 'First message reaction score',
			'_type' => 'option',
		);
	}
	$__finalCompiled .= $__templater->formRow('
					<div class="inputGroup u-inputSpacer">
						' . $__templater->formSelect(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][order_type]',
		'value' => $__vars['tab']['order_type'],
	), $__compilerTemp3) . '
						<span class="inputGroup-splitter"></span>
						' . $__templater->formSelect(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][order_direction]',
		'value' => $__vars['tab']['order_direction'],
	), array(array(
		'value' => 'desc',
		'label' => 'Descending',
		'_type' => 'option',
	),
	array(
		'value' => 'asc',
		'label' => 'Ascending',
		'_type' => 'option',
	))) . '
					</div>
				', array(
		'label' => 'Sort by' . $__vars['xf']['language']['label_separator'],
	)) . '
			</div>
			<div class="tabFields hiddenContainer hiddenContainer_thread_hotest hiddenContainer_most_reply">
				' . $__templater->formNumberBoxRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][cut_off]',
		'value' => $__templater->filter($__vars['tab']['cut_off'], array(array('raw', array()),), false),
		'min' => '0',
		'tep' => '1',
	), array(
		'label' => 'Thread Date Cut Off',
	)) . '
			</div>
			<div class="tabFields">
				';
	$__compilerTemp4 = array(array(
		'value' => '',
		'label' => '(' . 'All' . ')',
		'_type' => 'option',
	));
	if ($__templater->isTraversable($__vars['forums'])) {
		foreach ($__vars['forums'] AS $__vars['forum']) {
			$__compilerTemp4[] = array(
				'value' => $__vars['forum']['value'],
				'label' => $__templater->escape($__vars['forum']['label']),
				'disabled' => $__vars['forum']['disabled'],
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][forums]',
		'value' => $__templater->filter($__vars['tab']['forums'], array(array('raw', array()),), false),
		'size' => '5',
		'multiple' => 'true',
	), $__compilerTemp4, array(
		'label' => 'Forum',
	)) . '
			</div>
			<div class="tabFields">
				';
	$__compilerTemp5 = array(array(
		'value' => '0',
		'label' => '(' . 'Any' . ')',
		'_type' => 'option',
	)
,array(
		'value' => '-1',
		'label' => '(' . 'None' . ')',
		'_type' => 'option',
	));
	$__compilerTemp5 = $__templater->mergeChoiceOptions($__compilerTemp5, $__vars['threadPrefixes']);
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][prefix_id]',
		'value' => $__templater->filter($__vars['tab']['prefix_id'], array(array('raw', array()),), false),
		'size' => '5',
		'multiple' => 'true',
	), $__compilerTemp5, array(
		'label' => 'Prefix',
	)) . '
			</div>
			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][discussion_state][visible]',
		'value' => 'visible',
		'selected' => $__vars['tab']['discussion_state']['visible'],
		'label' => 'Visible',
		'_type' => 'option',
	),
	array(
		'name' => 'tab_data[' . $__vars['counter'] . '][discussion_state][deleted]',
		'value' => 'deleted',
		'selected' => $__vars['tab']['discussion_state']['deleted'],
		'label' => 'Deleted',
		'_type' => 'option',
	),
	array(
		'name' => 'tab_data[' . $__vars['counter'] . '][discussion_state][moderated]',
		'value' => 'moderated',
		'selected' => $__vars['tab']['discussion_state']['moderated'],
		'label' => 'Moderated',
		'_type' => 'option',
	)), array(
		'label' => 'State',
	)) . '
			' . $__templater->formCheckBoxRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][discussion_open]',
	), array(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][discussion_open][unlocked]',
		'value' => 'unlocked',
		'selected' => $__vars['tab']['discussion_open']['unlocked'],
		'label' => 'Unlocked',
		'_type' => 'option',
	),
	array(
		'name' => 'tab_data[' . $__vars['counter'] . '][discussion_open][locked]',
		'value' => 'locked',
		'selected' => $__vars['tab']['discussion_open']['locked'],
		'label' => 'Locked',
		'_type' => 'option',
	)), array(
		'label' => 'Locked',
	)) . '
		</div>
		';
	if ($__vars['resourceVersion']) {
		$__finalCompiled .= '
			<div class="tabFields hiddenContainer hiddenContainer_resource">
				';
		$__compilerTemp6 = array(array(
			'value' => '',
			'label' => 'None',
			'_type' => 'option',
		));
		$__compilerTemp6 = $__templater->mergeChoiceOptions($__compilerTemp6, $__vars['listTypeResources']);
		$__finalCompiled .= $__templater->formSelectRow(array(
			'name' => 'tab_data[' . $__vars['counter'] . '][type_resource]',
			'class' => 'autoSize tabType',
			'value' => $__templater->filter($__vars['tab']['type'], array(array('raw', array()),), false),
		), $__compilerTemp6, array(
			'label' => 'Resource Type',
		)) . '
				<div class="tabFields">
					';
		$__compilerTemp7 = array(array(
			'value' => '',
			'label' => '(' . 'All' . ')',
			'_type' => 'option',
		));
		$__compilerTemp7 = $__templater->mergeChoiceOptions($__compilerTemp7, $__vars['resourceCategoryOptions']);
		$__finalCompiled .= $__templater->formSelectRow(array(
			'name' => 'tab_data[' . $__vars['counter'] . '][categories]',
			'value' => $__templater->filter($__vars['tab']['categories'], array(array('raw', array()),), false),
			'size' => '5',
			'multiple' => 'true',
		), $__compilerTemp7, array(
			'label' => 'Categories',
		)) . '
				</div>
				<div class="tabFields">
					';
		$__compilerTemp8 = array(array(
			'value' => '0',
			'label' => '(' . 'Any' . ')',
			'_type' => 'option',
		)
,array(
			'value' => '-1',
			'label' => '(' . 'None' . ')',
			'_type' => 'option',
		));
		$__compilerTemp8 = $__templater->mergeChoiceOptions($__compilerTemp8, $__vars['resourcePrefixes']);
		$__finalCompiled .= $__templater->formSelectRow(array(
			'name' => 'tab_data[' . $__vars['counter'] . '][resource_prefix_id]',
			'value' => $__templater->filter($__vars['tab']['resource_prefix_id'], array(array('raw', array()),), false),
			'size' => '5',
			'multiple' => 'true',
		), $__compilerTemp8, array(
			'label' => 'Prefix',
		)) . '
				</div>
				' . $__templater->formCheckBoxRow(array(
		), array(array(
			'name' => 'tab_data[' . $__vars['counter'] . '][resource_state][visible]',
			'value' => 'visible',
			'selected' => $__vars['tab']['resource_state']['visible'],
			'label' => 'Visible',
			'_type' => 'option',
		),
		array(
			'name' => 'tab_data[' . $__vars['counter'] . '][resource_state][deleted]',
			'value' => 'deleted',
			'selected' => $__vars['tab']['resource_state']['deleted'],
			'label' => 'Deleted',
			'_type' => 'option',
		),
		array(
			'name' => 'tab_data[' . $__vars['counter'] . '][resource_state][moderated]',
			'value' => 'moderated',
			'selected' => $__vars['tab']['resource_state']['moderated'],
			'label' => 'Moderated',
			'_type' => 'option',
		)), array(
			'label' => 'State',
		)) . '
			</div>
		';
	}
	$__finalCompiled .= '
		<div class="tabFields hideParent hiddenContainer hiddenContainer_user">
			';
	$__compilerTemp9 = array(array(
		'value' => '',
		'label' => 'None',
		'_type' => 'option',
	));
	$__compilerTemp9 = $__templater->mergeChoiceOptions($__compilerTemp9, $__vars['listTypeUsers']);
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][type_user]',
		'class' => 'autoSize hiddenSelector tabType',
		'value' => $__templater->filter($__vars['tab']['type'], array(array('raw', array()),), false),
	), $__compilerTemp9, array(
		'label' => 'User Type',
	)) . '
			';
	if ($__vars['currencyOptions']) {
		$__finalCompiled .= '
				<div class="tabFields hiddenContainer hiddenContainer_user_richest hiddenContainer_user_poorest">
					';
		$__compilerTemp10 = $__templater->mergeChoiceOptions(array(), $__vars['currencyOptions']);
		$__finalCompiled .= $__templater->formSelectRow(array(
			'name' => 'tab_data[' . $__vars['counter'] . '][currency_id]',
			'class' => 'autoSize',
			'value' => $__templater->filter($__vars['tab']['currency_id'], array(array('raw', array()),), false),
		), $__compilerTemp10, array(
			'label' => 'BRC_currencies',
		)) . '
				</div>
			';
	}
	$__finalCompiled .= '
			<div class="tabFields">
				';
	$__compilerTemp11 = array(array(
		'value' => '',
		'label' => '(' . 'All' . ')',
		'_type' => 'option',
	));
	$__compilerTemp11[] = array(
		'label' => '',
		'_type' => 'optgroup',
		'options' => array(),
	);
	end($__compilerTemp11); $__compilerTemp12 = key($__compilerTemp11);
	$__compilerTemp11[$__compilerTemp12]['options'] = $__templater->mergeChoiceOptions($__compilerTemp11[$__compilerTemp12]['options'], $__vars['userGroups']);
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][user_groups]',
		'value' => $__templater->filter($__vars['tab']['user_groups'], array(array('raw', array()),), false),
		'size' => '5',
		'multiple' => 'true',
	), $__compilerTemp11, array(
		'label' => 'User groups',
	)) . '
			</div>
			<div class="tabFields">
				' . $__templater->formCheckBoxRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][user_state]',
	), array(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][user_state][valid]',
		'value' => 'valid',
		'selected' => $__vars['tab']['user_state']['valid'],
		'label' => 'Valid',
		'_type' => 'option',
	),
	array(
		'name' => 'tab_data[' . $__vars['counter'] . '][user_state][email_confirm]',
		'value' => 'email_confirm',
		'selected' => $__vars['tab']['user_state']['email_confirm'],
		'label' => 'Awaiting email confirmation',
		'_type' => 'option',
	),
	array(
		'name' => 'tab_data[' . $__vars['counter'] . '][user_state][email_confirm_edit]',
		'value' => 'email_confirm_edit',
		'selected' => $__vars['tab']['user_state']['email_confirm_edit'],
		'label' => 'Awaiting email confirmation (from edit)',
		'_type' => 'option',
	),
	array(
		'name' => 'tab_data[' . $__vars['counter'] . '][user_state][email_bounce]',
		'value' => 'email_bounce',
		'selected' => $__vars['tab']['user_state']['email_bounce'],
		'label' => 'Email invalid (bounced)',
		'_type' => 'option',
	),
	array(
		'name' => 'tab_data[' . $__vars['counter'] . '][user_state][moderated]',
		'value' => 'moderated',
		'selected' => $__vars['tab']['user_state']['moderated'],
		'label' => 'Awaiting moderation',
		'_type' => 'option',
	)), array(
		'label' => 'User state',
	)) . '
			</div>
		</div>
		<div class="tabFields hideParent hiddenContainer hiddenContainer_profile_post">
			';
	$__compilerTemp13 = array(array(
		'value' => '',
		'label' => 'None',
		'_type' => 'option',
	));
	$__compilerTemp13 = $__templater->mergeChoiceOptions($__compilerTemp13, $__vars['listTypeProfilePosts']);
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'tab_data[' . $__vars['counter'] . '][type_profile_post]',
		'class' => 'autoSize hiddenSelector tabType',
		'value' => $__templater->filter($__vars['tab']['type'], array(array('raw', array()),), false),
	), $__compilerTemp13, array(
		'label' => 'Profile Post Type',
	)) . '
		</div>
	</div>
</div>';
	return $__finalCompiled;
});