<?php
namespace BR\ModernStatistic\XF\Template;

class Templater extends XFCP_Templater
{
	public function callAdsMacro($position, array $arguments, array $globalVars)
	{
		$ads = parent::callAdsMacro($position, $arguments, $globalVars);
		/** @var \XF\Service\Advertising\Writer $service */
		$service = $this->app->service('BR\ModernStatistic:ModernStatistic\Render', 'ads:' . $position);
		$service->setLoadedTemplates($this->loadedTemplates);
		$service->setTemplateParams($globalVars);
		$ads .= $service->render();
		return $ads;
	}

	protected $loadedTemplates = [];
	protected $firstParams = null;

	public function renderTemplate($template, array $params = [], $addDefaultParams = true)
	{
		/*if($this->firstParams == null){
			$this->firstParams = $params;
		}*/
		$this->loadedTemplates[] = str_replace('public:', '', $template);

		return parent::renderTemplate($template, $params, $addDefaultParams);
	}
}
