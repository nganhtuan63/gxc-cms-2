<?php
/**
 * CmsAppCommand class file.
 *
 * Create CMS App command based on Quiang Web App Command
 */
class CmsAppCommand extends CConsoleCommand
{
	private $_rootPath;

	public function getHelp()
	{
		return <<<EOD
USAGE
  cms cmsapp <app-path>

DESCRIPTION
  This command generates an GXC-CMS Web Application at the specified location.

PARAMETERS
 * app-path: required, the directory where the new application will be created.
   If the directory does not exist, it will be created. After the application
   is created, please make sure the directory can be accessed by Web users.

EOD;
	}

	/**
	 * Execute the action.
	 * @param array command line parameters specific for this command
	 */
	public function run($args)
	{
		if(!isset($args[0]))
			$this->usageError('the Web application location is not specified.');
		$path=strtr($args[0],'/\\',DIRECTORY_SEPARATOR);
		if(strpos($path,DIRECTORY_SEPARATOR)===false)
			$path='.'.DIRECTORY_SEPARATOR.$path;
		$dir=rtrim(realpath(dirname($path)),'\\/');
		if($dir===false || !is_dir($dir))
			$this->usageError("The directory '$path' is not valid. Please make sure the parent directory exists.");
		if(basename($path)==='.')
			$this->_rootPath=$path=$dir;
		else
			$this->_rootPath=$path=$dir.DIRECTORY_SEPARATOR.basename($path);
		if($this->confirm("Create a Web application under '$path'?"))
		{
			$sourceDir=realpath(dirname(__FILE__).'/../apps');
			if($sourceDir===false)
				die("\nUnable to locate the source directory.\n");
			$list=$this->buildFileList($sourceDir,$path);

			$list['backend/protected/config/environment.php']['callback']=array($this,'generateBackendEnvironment');
			$list['web/protected/config/environment.php']['callback']=array($this,'generateWebEnvironment');
			$this->copyFiles($list);
			@chmod($path.'/assets',0777);
			@chmod($path.'/protected/runtime',0777);
			@chmod($path.'/protected/data',0777);
			@chmod($path.'/protected/data/testdrive.db',0777);
			@chmod($path.'/protected/yiic',0755);
			echo "\nYour application has been created successfully under {$path}.\n";
		}
	}

	public function generateBackendEnvironment($source,$params)
	{
		$content=file_get_contents($source);
		$core_folder=realpath(dirname(__FILE__).'/../../');
		//$yii=realpath(dirname(__FILE__).'/../../../yii/framework/yii.php');
		$core_folder=$this->getRelativePath($core_folder,$this->_rootPath.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'protected'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'environment.php');		
		return str_replace("dirname(dirname(dirname(dirname(dirname(__FILE__))))).DIRECTORY_SEPARATOR.'core'",$core_folder,$content);		
	}

	public function generateWebEnvironment($source,$params)
	{
		$content=file_get_contents($source);
		$core_folder=realpath(dirname(__FILE__).'/../../');
		//$yii=realpath(dirname(__FILE__).'/../../../yii/framework/yii.php');
		$core_folder=$this->getRelativePath($core_folder,$this->_rootPath.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'protected'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'environment.php');		
		return str_replace("dirname(dirname(dirname(dirname(dirname(__FILE__))))).DIRECTORY_SEPARATOR.'core'",$core_folder,$content);		
	}		

	protected function getRelativePath($path1,$path2)
	{
		$segs1=explode(DIRECTORY_SEPARATOR,$path1);
		$segs2=explode(DIRECTORY_SEPARATOR,$path2);
		$n1=count($segs1);
		$n2=count($segs2);

		for($i=0;$i<$n1 && $i<$n2;++$i)
		{
			if($segs1[$i]!==$segs2[$i])
				break;
		}

		if($i===0)
			return "'".$path1."'";
		$up='';
		for($j=$i;$j<$n2-1;++$j)
			$up.='/..';
		for(;$i<$n1-1;++$i)
			$up.='/'.$segs1[$i];

		return 'dirname(__FILE__).\''.$up.'/'.basename($path1).'\'';
	}
}