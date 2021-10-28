<?php

namespace DBTech\Credits;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

/**
 * Class Setup
 *
 * @package DBTech\Credits
 */
class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;
	
	/**
	 * @param array $errors
	 * @param array $warnings
	 */
	public function checkRequirements(&$errors = [], &$warnings = [])
	{
		$addOns = $this->app->container('addon.cache');
		
		if (array_key_exists('DBTech/Shop', $addOns) && $addOns['DBTech/Shop'] < 906010011)
		{
			$warnings[] = "Your version of DragonByte Shop is not compatible with this version of DragonByte Credits.
			The integration between these two products will not function until you also update DragonByte Shop,
			and may cause errors. Please consider deactivating DragonByte Shop, or upgrade it if an upgrade is available.";
		}
		
		return;
	}
	
	// ################################ INSTALLATION ####################
	
	/**
	 *
	 */
	public function installStep1()
	{
		$sm = $this->schemaManager();
		
		foreach ($this->getTables() AS $tableName => $closure)
		{
			$sm->createTable($tableName, $closure);
		}
	}
	
	/**
	 *
	 */
	public function installStep2()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_user', function(Alter $table)
		{
			$table->addColumn('dbtech_credits_credits', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('dbtech_credits_lastdaily', 'int')->setDefault(0);
			$table->addColumn('dbtech_credits_lastinterest', 'int')->setDefault(0);
			$table->addColumn('dbtech_credits_lastpaycheck', 'int')->setDefault(0);
			$table->addColumn('dbtech_credits_lasttaxation', 'int')->setDefault(0);
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function installStep3()
	{
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_currency`
				(`currency_id`, `title`, `description`, `display_order`, `table`, `use_table_prefix`, `column`, `use_user_id`, `user_id_column`, `decimals`, `negative`, `privacy`)
			VALUES
				(1, 'Credits', 'Classic DragonByte Credits points field.', 10, 'user', 1, 'dbtech_credits_credits', 1, 'user_id', 0, 2, 2)
		");
		
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_event`
				(`event_id`, `currency_id`, `event_trigger_id`, `user_group_ids`, `node_ids`, `active`, `moderate`, `charge`, `main_add`, `main_sub`, `mult_add`, `mult_sub`, `delay`, `frequency`, `maxtime`, `applymax`, `upperrand`, `multmin`, `multmax`, `minaction`, `owner`, `curtarget`, `alert`)
			VALUES
				(1, 1, 'post', '[]', '[]', 1, 0, 0, 5, 5, 0.01, 0.01, 0, 1, 0, 0, '0', 0, 0, 0, 0, 0, 0),
				(2, 1, 'thread', '[]', '[]', 1, 0, 0, 10, 10, 0.01, 0.01, 0, 1, 0, 0, '0', 0, 0, 0, 0, 0, 0)
		");
		
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_event_trigger`
				(`event_trigger_id`, `title`, `description`, `active`, `callback_class`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `charge`, `usergroups`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('adjust', 'Adjust', X'4D616E6970756C6174696E67207468652063757272656E6379206F6620736F6D656F6E6520656C73652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Adjust', 3, '', 1, '', 'accounts', 1, 1, 1, 0, 1, 1, 2, 'member.php?u=', 1, 1, 1, '[]'),
				('avatar', 'Upload Avatar', X'55706C6F6164696E672061206E6577206176617461722E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Avatar', 0, '', 0, '', 'accounts', 1, 1, 1, 1, 1, 1, 0, '', 1, 1, 1, '[]'),
				('birthday', 'Birthday', X'41776172646564206F6E206D69646E69676874206163636F7264696E6720746F2070726F66696C652E204576656E74732073686F756C64206265206C696D6974656420746F20616E6E75616C2E204D756C7469706C696572206973206167652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Birthday', 1, 'Years|Year', 0, '', 'time', 1, 0, 0, 1, 1, 1, 0, '', 1, 1, 1, '[]'),
				('content', 'Content', X'4368617267696E67206F7468657220757365727320746F207669657720796F7572206D61726B656420636F6E74656E742E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Content', 3, '', 0, 'Post', 'discuss', 0, 0, 1, 0, 1, 1, 1, '', 1, 1, 1, '[]'),
				('daily', 'Daily Activity', X'41776172646564206F6E206669727374206C6F67696E2065616368206461792E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Daily', 0, '', 0, '', 'time', 1, 0, 0, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('donate', 'Donate', X'5472616E7366657272696E672063757272656E637920746F20616E6F7468657220757365722E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Donate', 3, '', 0, '', 'accounts', 1, 0, 1, 0, 1, 1, 1, 'member.php?u=', 1, 1, 1, '[]'),
				('download', 'Download', X'446F776E6C6F6164696E67206120666F72756D206174746163686D656E742E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Download', 1, 'Bytes|Byte', 0, 'Attachment', 'share', 0, 0, 1, 0, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('downloaded', 'Downloaded', X'536F6D656F6E6520656C736520646F776E6C6F6164696E6720796F7572206174746163686D656E742E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Downloaded', 1, 'Bytes|Byte', 0, '', 'share', 0, 0, 0, 0, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('follow', 'Follow', X'466F6C6C6F77696E6720736F6D656F6E6520656C73652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Follow', 0, '', 0, '', 'network', 1, 1, 1, 1, 1, 1, 0, 'member.php?u=', 1, 1, 1, '[]'),
				('followed', 'Followed', X'536F6D656F6E6520656C736520666F6C6C6F77696E6720796F752E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Followed', 0, '', 0, '', 'network', 1, 1, 1, 1, 1, 1, 0, 'member.php?u=', 1, 1, 1, '[]'),
				('gallerycomment', 'MediaGallery Comment', X'416464696E67206120636F6D6D656E7420746F2061204D6564696147616C6C657279206D65646961207265736F757263652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Gallery\\\Comment', 2, '', 0, 'Media', 'discuss', 1, 1, 1, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('gallerycommented', 'MediaGallery Commented', X'536F6D656F6E6520656C736520636F6D6D656E74696E67206F6E20796F7572204D6564696147616C6C657279206D65646961207265736F757263652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Gallery\\\Commented', 2, '', 0, '', 'discuss', 1, 1, 0, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('gallerydownload', 'MediaGallery Download', X'446F776E6C6F6164696E67204D6564696147616C6C657279206D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Gallery\\\Download', 1, 'Bytes|Byte', 0, 'Media', 'share', 1, 0, 1, 0, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('gallerydownloaded', 'MediaGallery Downloaded', X'536F6D656F6E6520656C736520646F776E6C6F6164696E6720796F7572204D6564696147616C6C657279206D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Gallery\\\Downloaded', 1, 'Bytes|Byte', 0, '', 'share', 1, 0, 0, 0, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('galleryrate', 'MediaGallery Rate', X'526174696E67204D6564696147616C6C657279206D656469612E204D756C7469706C69657220697320726174696E672E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Gallery\\\Rate', 1, 'Stars|Star', 0, 'Media', 'opinion', 1, 1, 1, 1, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('galleryrated', 'MediaGallery Rated', X'536F6D656F6E6520656C736520726174656420796F7572204D6564696147616C6C657279206D656469612E204D756C7469706C69657220697320726174696E672E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Gallery\\\Rated', 1, 'Stars|Star', 0, '', 'opinion', 1, 1, 0, 1, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('galleryupload', 'MediaGallery Upload', X'55706C6F6164696E67206E6577204D6564696147616C6C657279204D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Gallery\\\Upload', 1, 'Bytes|Byte', 0, '', 'share', 1, 1, 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('interest', 'Interest', X'47726F77696E67207468652076616C7565206F6620796F75722063757272656E6379206F7665722074696D652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Interest', 1, 'Currency|Currency', 0, '', 'time', 1, 0, 0, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('like', 'Post Like', X'4C696B696E67206120706F73742E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Like', 0, '', 0, 'Post', 'opinion', 0, 1, 1, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('liked', 'Post Liked', X'536F6D656F6E6520656C7365206C696B656420796F757220706F73742E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Liked', 0, '', 0, '', 'opinion', 0, 1, 1, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('message', 'Conversation', X'53656E64696E6720612070726976617465206D6573736167652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Message', 2, '', 0, '', 'network', 1, 0, 1, 1, 1, 1, 0, '', 1, 1, 1, '[]'),
				('openbet', 'Sportsbook Open Bet', X'4372656174696E6720616E206F70656E20626574', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SportsBook\\\OpenBet', 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('openbetaccept', 'Sportsbook Open Bet Accept', X'416363657074696E6720616E206F70656E20626574', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SportsBook\\\OpenBetAccept', 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('openbetaccepted', 'Sportsbook Open Bet Accepted', X'536F6D656F6E6520616363657074696E6720796F7572206F70656E20626574', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SportsBook\\\OpenBetAccepted', 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('paycheck', 'Paycheck', X'4F636375727320617420726567756C617220696E74657276616C732E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Paycheck', 0, '', 0, '', 'time', 1, 0, 0, 1, 1, 1, 0, '', 1, 1, 1, '[]'),
				('poll', 'Poll', X'4372656174696E67206120706F6C6C2E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Poll', 1, 'Options|Option', 0, '', 'opinion', 0, 1, 1, 1, 1, 1, 0, 'poll.php?do=showresults&pollid=', 1, 1, 1, '[]'),
				('post', 'Post', X'416464696E67206120706F737420746F2061207468726561642E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Post', 2, '', 0, 'Thread', 'discuss', 0, 1, 1, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('postrate', 'Post Rate', X'526174696E67206120706F7374207573696E67207468652022506F737420526174696E677322206D6F642E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\PostRating\\\Rate', 0, '', 1, 'Post', 'opinion', 0, 1, 0, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('postrated', 'Post Rated', X'536F6D656F6E6520656C736520726174656420796F757220706F7374207573696E67207468652022506F737420526174696E677322206D6F642E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\PostRating\\\Rated', 0, '', 1, '', 'opinion', 0, 1, 0, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('profile', 'Profile', X'56696577696E6720612070726F66696C652E204561726E696E67206576656E74732073686F756C64206265206C696D697465642E2043686172676564206576656E74732077696C6C206C6F636B206F7574206775657374732E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Profile', 0, '', 0, 'Profile', 'network', 1, 0, 1, 0, 1, 1, 0, 'member.php?u=', 1, 1, 1, '[]'),
				('punish', 'Give Warning', X'4170706C79696E672061207761726E696E6720746F20736F6D656F6E6520656C73652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Punish', 1, 'Points|Point', 0, '', 'behave', 1, 1, 0, 1, 1, 1, 0, 'infraction.php?do=view&warningid=', 1, 1, 1, '[]'),
				('purchase', 'Purchase', X'427579696E672063757272656E637920666F72207265616C206D6F6E6579207468726F75676820616E7920636F6E66696775726564207061796D656E742070726F636573736F722E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Purchase', 3, '', 1, 'Account', 'accounts', 1, 1, 0, 1, 1, 1, 2, '', 1, 1, 1, '[]'),
				('read', 'View', X'56696577696E672061207468726561642E2043686172676564206576656E74732077696C6C206C6F636B206F7574206775657374732E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Read', 0, '', 0, 'Thread', 'discuss', 0, 0, 1, 0, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('redeem', 'Redeem', X'5573696E67206120726564656D7074696F6E20636F6465206F72207669736974696E672061207370656369616C206C696E6B2E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Redeem', 3, '', 1, 'Account', 'accounts', 1, 0, 0, 0, 1, 1, 2, '', 1, 1, 1, '[]'),
				('registration', 'Registration', X'41206E6577207573657220726567697374657273206F6E2074686520666F72756D2E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Registration', 0, '', 0, '', 'accounts', 1, 0, 0, 1, 0, 0, 0, '', 1, 1, 1, '[]'),
				('reply', 'Reply', X'536F6D656F6E6520656C736520706F7374696E6720696E20796F7572207468726561642E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Reply', 0, '', 0, '', 'discuss', 0, 1, 0, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('report', 'Report', X'5265706F7274696E672061207069656365206F6620636F6E74656E7420746F20746865206D6F64657261746F72732E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Report', 0, '', 0, '', 'behave', 1, 0, 1, 1, 1, 1, 0, '', 1, 1, 1, '[]'),
				('reported', 'Reported', X'596F757220636F6E74656E7420776173207265706F7274656420746F20746865206D6F64657261746F72732E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Reported', 0, '', 0, '', 'behave', 1, 0, 1, 1, 1, 1, 0, '', 1, 1, 1, '[]'),
				('resourcedownload', 'XenResource Download', X'446F776E6C6F6164696E6720612058656E5265736F75726365207265736F757263652E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Resource\\\Download', 1, 'Bytes|Byte', 0, 'Resource', 'share', 1, 0, 1, 0, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('resourcedownloaded', 'XenResource Downloaded', X'536F6D656F6E6520656C736520646F776E6C6F6164696E6720796F75722058656E5265736F75726365207265736F757263652E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Resource\\\Downloaded', 1, 'Bytes|Byte', 0, '', 'share', 1, 0, 0, 0, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('resourcerate', 'XenResource Rate', X'526174696E6720612058656E5265736F75726365207265736F757263652E204D756C7469706C69657220697320726174696E672E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Resource\\\Rate', 1, 'Stars|Star', 0, 'Resource', 'opinion', 1, 1, 1, 1, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('resourcerated', 'XenResource Rated', X'536F6D656F6E6520656C736520726174656420796F75722058656E5265736F75726365207265736F757263652E204D756C7469706C69657220697320726174696E672E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Resource\\\Rated', 1, 'Stars|Star', 0, '', 'opinion', 1, 1, 0, 1, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('resourceupdate', 'XenResource Update', X'416464696E6720616E2075706461746520746F20612058656E5265736F75726365207265736F757263652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Resource\\\Update', 0, '', 0, '', 'share', 1, 1, 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('resourceupload', 'XenResource Upload', X'55706C6F6164696E672061206E65772058656E5265736F75726365207265736F757263652E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Resource\\\Upload', 1, 'Bytes|Byte', 0, '', 'share', 1, 1, 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('revival', 'Revive', X'506F7374696E6720696E206120646F726D616E74207468726561642E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Revival', 1, 'Days|Day', 0, 'Thread', 'discuss', 0, 0, 1, 0, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('sticky', 'Sticky', X'5768656E206F6E65206F6620796F75722074687265616473206265636F6D657320737469636B792E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Sticky', 0, '', 0, '', 'discuss', 0, 1, 0, 1, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('tag', 'Tag', X'4170706C79696E672061206465736372697074697665206C6162656C20746F2061207468726561642E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Tag', 0, '', 0, 'Thread', 'discuss', 0, 1, 1, 1, 1, 1, 0, 'tags.php?tag=', 1, 1, 1, '[]'),
				('targetbet', 'Sportsbook Bet Challenge', X'4372656174696E67206120626574206368616C6C656E6765207769746820616E6F74686572206D656D626572', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SportsBook\\\TargetBet', 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('targetbetaccept', 'Sportsbook Bet Challenge Accept', X'416363657074696E67206120626574206368616C6C656E6765', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SportsBook\\\TargetBetAccept', 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('targetbetaccepted', 'Sportsbook Bet Challenge Accepted', X'536F6D656F6E6520616363657074696E6720796F757220626574206368616C6C656E6765', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SportsBook\\\TargetBetAccepted', 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('taxation', 'Taxation', X'4175746F6D61746963616C6C7920746178206D656D62657273272063757272656E63696573206F7665722074696D652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Taxation', 1, 'Currency|Currency', 0, '', 'time', 1, 0, 0, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('thread', 'Thread', X'4372656174696E67206120666F72756D20746F7069632E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Thread', 2, '', 0, '', 'discuss', 0, 1, 1, 1, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('transfer', 'Transfer', X'4D6F76696E6720796F7572206F776E2063757272656E63792066726F6D206F6E6520666F726D20746F20616E6F746865722E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Transfer', 3, '', 1, '', 'accounts', 1, 0, 1, 0, 1, 1, 2, '', 1, 1, 1, '[]'),
				('trophy', 'Trophy', X'4265696E6720617761726465642061206E65772074726F7068792E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Trophy', 0, '', 0, '', 'accounts', 1, 0, 0, 1, 1, 1, 0, '', 1, 1, 1, '[]'),
				('upload', 'Upload', X'55706C6F6164696E672061206E6577206174746163686D656E742E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Upload', 1, 'Bytes|Byte', 0, '', 'share', 0, 1, 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('view', 'Viewed', X'536F6D656F6E6520656C73652076696577696E6720796F7572207468726561642E204576656E74732073686F756C64206265206C696D697465642E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\View', 0, '', 0, '', 'discuss', 0, 0, 0, 0, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('visit', 'Visit', X'536F6D656F6E6520656C73652076696577696E6720796F75722070726F66696C652E204576656E74732073686F756C64206265206C696D697465642E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Visit', 0, '', 0, '', 'network', 1, 0, 0, 0, 1, 1, 0, 'member.php?u=', 1, 1, 1, '[]'),
				('visitor', 'Message', X'506F7374696E6720612076697369746F72206D657373616765206F6E20612070726F66696C652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Visitor', 2, '', 0, 'Profile', 'network', 1, 1, 1, 1, 1, 1, 0, 'member.php?u=', 1, 1, 1, '[]'),
				('vote', 'Vote', X'43686F6F73696E6720706F6C6C206F7074696F6E732E204D756C7469706C69657220697320746865206E756D6265722073656C65637465642E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Vote', 1, 'Options|Option', 0, 'Poll', 'opinion', 0, 1, 1, 1, 1, 1, 0, 'poll.php?do=showresults&pollid=', 1, 1, 1, '[]'),
				('wager', 'Sportsbook Wager', X'506C6163696E672061207761676572206F6E20616E206576656E74', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SportsBook\\\Wager', 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('wagered', 'Sportsbook Wagered', X'536F6D656F6E6520706C616365642061207761676572206F6E20796F7572206576656E74', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SportsBook\\\Wagered', 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, '[]'),
				('wall', 'Messaged', X'536F6D656F6E6520656C736520676976696E6720796F7520612076697369746F72206D657373616765206F6E20796F75722070726F66696C652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Wall', 2, '', 0, '', 'network', 1, 1, 0, 1, 1, 1, 0, 'member.php?u=', 1, 1, 1, '[]'),
				('warning', 'Warning', X'47657474696E672061207761726E696E672E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\Warning', 1, 'Points|Point', 0, '', 'behave', 1, 1, 0, 1, 1, 1, 0, 'infraction.php?do=view&infractionid=', 1, 1, 1, '[]'),
				('xengallerycomment', 'XenGallery Comment', X'416464696E67206120636F6D6D656E7420746F20612058656E47616C6C657279206D65646961207265736F757263652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SonnbGallery\\\Comment', 2, '', 0, 'Media', 'discuss', 1, 1, 1, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('xengallerycommented', 'XenGallery Commented', X'536F6D656F6E6520656C736520636F6D6D656E74696E67206F6E20796F75722058656E47616C6C657279206D65646961207265736F757263652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SonnbGallery\\\Commented', 2, '', 0, '', 'discuss', 1, 1, 0, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('xengallerydownload', 'XenGallery Download', X'446F776E6C6F6164696E672058656E47616C6C657279206D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SonnbGallery\\\Download', 1, 'Byte|Bytes', 0, 'Media', 'share', 1, 0, 1, 0, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('xengallerydownloaded', 'XenGallery Downloaded', X'536F6D656F6E6520656C736520646F776E6C6F6164696E6720796F75722058656E47616C6C657279206D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SonnbGallery\\\Downloaded', 1, 'Byte|Bytes', 0, '', 'share', 1, 0, 0, 0, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('xengalleryrate', 'XenGallery Rate', X'526174696E672058656E47616C6C657279206D656469612E204D756C7469706C69657220697320726174696E672E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SonnbGallery\\\Rate', 1, 'Star|Stars', 0, 'Media', 'opinion', 1, 1, 1, 0, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('xengalleryrated', 'XenGallery Rated', X'536F6D656F6E6520656C736520726174656420796F75722058656E47616C6C657279206D656469612E204D756C7469706C69657220697320726174696E672E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SonnbGallery\\\Rated', 1, 'Star|Stars', 0, '', 'opinion', 1, 1, 0, 0, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, '[]'),
				('xengalleryupload', 'XenGallery Upload', X'55706C6F6164696E67206E65772058656E47616C6C657279204D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\SonnbGallery\\\Upload', 1, 'Byte|Bytes', 0, '', 'share', 1, 1, 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]'),
				('xenmediocomment', 'XenMedio Comment', X'416464696E67206120636F6D6D656E7420746F20612058656E4D6564696F206D65646961207265736F757263652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\JaxelMedio\\\Comment', 2, '', 0, 'Media', 'discuss', 1, 1, 1, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('xenmediocommented', 'XenMedio Commented', X'536F6D656F6E6520656C736520636F6D6D656E74696E67206F6E20796F75722058656E4D6564696F206D65646961207265736F757263652E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\JaxelMedio\\\Commented', 2, '', 0, '', 'discuss', 1, 1, 0, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, '[]'),
				('xenmedioupload', 'XenMedio Upload', X'416464696E67206E65772058656E4D6564696F204D656469612E', 1, 'DBTech\\\Credits\\\Model\\\Event\\\JaxelMedio\\\Upload', 0, '', 0, '', 'share', 1, 1, 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, '[]')
		");
		
		$this->query("
			REPLACE INTO `xf_purchasable`
				(`purchasable_type_id`, `purchasable_class`, `addon_id`)
			VALUES
				('dbtech_credits_currency', 'DBTech\\\\Credits:Currency', X'4442546563682F43726564697473')
		");
		
		foreach ($this->getAdminPermissions() AS $permissionId)
		{
			$this->query("
				REPLACE INTO xf_admin_permission_entry
					(user_id, admin_permission_id)
				SELECT user_id, '$permissionId'
				FROM xf_admin_permission_entry
				WHERE admin_permission_id = 'option'
			");
		}
		
		foreach ($this->getDefaultWidgetSetup() AS $widgetKey => $widgetFn)
		{
			$widgetFn($widgetKey);
		}
	}
	
	/**
	 * @param array $stateChanges
	 *
	 * @throws \Exception
	 */
	public function postInstall(array &$stateChanges)
	{
		if ($this->applyDefaultPermissions())
		{
			// since we're running this after data imports, we need to trigger a permission rebuild
			// if we changed anything
			$this->app->jobManager()->enqueueUnique(
				'permissionRebuild',
				'XF:PermissionRebuild',
				[],
				false
			);
		}
		
		/** @var \DBTech\Credits\Repository\Currency $currencyRepo */
		$currencyRepo = \XF::repository('DBTech\Credits:Currency');
		$currencyRepo->rebuildCache();
	}
	
	
	// ################################ UPGRADES ####################
	
	/**
	 *
	 */
	public function upgrade20160301Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->createTable('xf_dbtech_credits_charge', function(Create $table)
		{
			$table->addColumn('postid', 'int');
			$table->addColumn('contenthash', 'char', 32);
			$table->addColumn('cost', 'double')->unsigned(false)->setDefault(0);
			$table->addPrimaryKey(['postid', 'contenthash']);
		});
		
		$sm->createTable('xf_dbtech_credits_charge_purchase', function(Create $table)
		{
			$table->addColumn('postid', 'int');
			$table->addColumn('contenthash', 'char', 32);
			$table->addColumn('userid', 'int');
			$table->addPrimaryKey(['postid', 'contenthash', 'userid']);
		});
		
		$sm->createTable('xf_dbtech_credits_purchase_log', function(Create $table)
		{
			$table->addColumn('logid', 'int')->autoIncrement();
			$table->addColumn('eventid', 'int')->setDefault(0);
			$table->addColumn('processor', 'varchar', 25)->setDefault('');
			$table->addColumn('transaction_id', 'varchar', 50)->setDefault('');
			$table->addColumn('subscriber_id', 'varchar', 50)->setDefault('');
			$table->addColumn('transaction_type', 'enum')->values(['payment','cancel','info','error'])->setDefault('info');
			$table->addColumn('message', 'varchar', 255)->setDefault('');
			$table->addColumn('transaction_details', 'mediumblob')->nullable(true);
			$table->addColumn('log_date', 'int')->setDefault(0);
			$table->addKey('transaction_id');
			$table->addKey('subscriber_id');
			$table->addKey('log_date');
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160301Step2()
	{
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `active` = '1'
				WHERE `eventtriggerid` IN('purchase', 'content')
		");
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160308Step1()
	{
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `active` = '1'
				WHERE `eventtriggerid` IN('birthday', 'warning', 'wall', 'visitor')
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `multiplier` = '2', `cancel` = '1'
				WHERE `eventtriggerid` = 'wall'
		");
	}
	
	/**
	 *
	 */
	public function upgrade20160315Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_user', function(Alter $table)
		{
			$table->addColumn('dbtech_credits_lastdaily', 'int')->setDefault(0);
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160315Step2()
	{
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger` SET `active` = '1' WHERE `eventtriggerid` IN('poll', 'sticky', 'vote')
		");
		
		$this->query("
			DELETE FROM `xf_dbtech_credits_eventtrigger` WHERE `eventtriggerid` IN('friend', 'evaluate', 'rate')
		");
		
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger`
				(`eventtriggerid`, `title`, `description`, `active`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('follow', 'Follow', X'466F6C6C6F77696E6720736F6D656F6E6520656C73652E', 1, 0, '', 0, '', 'network', 1, 1, 1, 1, 0, 'member.php?u=', 1, 1, 1, NULL),
				('followed', 'Followed', X'536F6D656F6E6520656C736520666F6C6C6F77696E6720796F752E', 1, 0, '', 0, '', 'network', 1, 1, 1, 1, 0, 'member.php?u=', 1, 1, 1, NULL),
				('daily', 'Daily Activity', X'41776172646564206F6E206669727374206C6F67696E2065616368206461792E', 1, 0, '', 0, '', 'time', 1, 0, 0, 0, 0, '', 1, 1, 1, NULL)
		");
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160322Step1()
	{
		$this->query("
			UPDATE `xf_option` SET `option_value` = 'a:3:{s:7:\"enabled\";s:1:\"1\";s:13:\"left_position\";s:3:\"end\";s:14:\"right_position\";b:0;}' WHERE `option_id` = 'dbtech_credits_navbar'
		");
		
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger`
				(`eventtriggerid`, `title`, `description`, `active`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('galleryupload', 'XenGallery Upload', X'55706C6F6164696E67206E65772058656E47616C6C657279204D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 1, 'Bytes|Byte', 0, '', 'share', 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL),
				('gallerydownload', 'XenGallery Download', X'446F776E6C6F6164696E672058656E47616C6C657279206D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 1, 'Bytes|Byte', 0, 'Media', 'share', 1, 0, 1, 0, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL),
				('gallerydownloaded', 'XenGallery Downloaded', X'536F6D656F6E6520656C736520646F776E6C6F6164696E6720796F75722058656E47616C6C657279206D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 1, 'Bytes|Byte', 0, '', 'share', 1, 0, 0, 0, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL),
				('galleryrate', 'XenGallery Rate', X'526174696E672058656E47616C6C657279206D656469612E204D756C7469706C69657220697320726174696E672E', 1, 1, 'Stars|Star', 0, 'Media', 'opinion', 1, 1, 1, 0, 0, 'showthread.php?t=', 1, 1, 1, NULL),
				('galleryrated', 'XenGallery Rated', X'536F6D656F6E6520656C736520726174656420796F75722058656E47616C6C657279206D656469612E204D756C7469706C69657220697320726174696E672E', 1, 1, 'Stars|Star', 0, '', 'opinion', 1, 1, 0, 0, 0, 'showthread.php?t=', 1, 1, 1, NULL),
				('gallerycomment', 'XenGallery Comment', X'416464696E67206120636F6D6D656E7420746F20612058656E47616C6C657279206D65646961207265736F757263652E', 1, 2, '', 0, 'Media', 'discuss', 1, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, NULL),
				('gallerycommented', 'XenGallery Commented', X'536F6D656F6E6520656C736520636F6D6D656E74696E67206F6E20796F75722058656E47616C6C657279206D65646961207265736F757263652E', 1, 2, '', 0, '', 'discuss', 1, 1, 0, 1, 0, 'showpost.php?p=', 1, 1, 1, NULL)
		");
	}
	
	/**
	 *
	 */
	public function upgrade20160328Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_currency', function(Alter $table)
		{
			$table->changeColumn('usercol', 'varchar', 255)->setDefault('user_id');
		});
		
		$sm->alterTable('xf_dbtech_credits_transaction', function(Alter $table)
		{
			$table->changeColumn('touserid', 'int')->setDefault(0)->renameTo('sourceuserid');
		});
		
		$sm->alterTable('xf_dbtech_credits_transaction_pending', function(Alter $table)
		{
			$table->changeColumn('touserid', 'int')->setDefault(0)->renameTo('sourceuserid');
		});
	}
	
	/**
	 *
	 */
	public function upgrade20160328Step2()
	{
		$sm = $this->schemaManager();
		
		foreach ([
			'conversion',
			'display',
			'payment',
			'redemption',
		] as $table)
		{
			// Quickly drop all tables
			$sm->dropTable("xf_dbtech_credits_{$table}");
		}
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160328Step3()
	{
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger` (`eventtriggerid`, `title`, `description`, `active`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('resourcedownload', 'XenResource Download', X'446F776E6C6F6164696E6720612058656E5265736F75726365207265736F757263652E204D756C7469706C6965722069732066696C6573697A652E', 1, 1, 'Bytes|Byte', 0, 'Resource', 'share', 1, 0, 1, 0, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL),
				('resourcedownloaded', 'XenResource Downloaded', X'536F6D656F6E6520656C736520646F776E6C6F6164696E6720796F75722058656E5265736F75726365207265736F757263652E204D756C7469706C6965722069732066696C6573697A652E', 1, 1, 'Bytes|Byte', 0, '', 'share', 1, 0, 0, 0, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL),
				('resourcerate', 'XenResource Rate', X'526174696E6720612058656E5265736F75726365207265736F757263652E204D756C7469706C69657220697320726174696E672E', 1, 1, 'Stars|Star', 0, 'Resource', 'opinion', 1, 1, 1, 0, 0, 'showthread.php?t=', 1, 1, 1, NULL),
				('resourcerated', 'XenResource Rated', X'536F6D656F6E6520656C736520726174656420796F75722058656E5265736F75726365207265736F757263652E204D756C7469706C69657220697320726174696E672E', 1, 1, 'Stars|Star', 0, '', 'opinion', 1, 1, 0, 0, 0, 'showthread.php?t=', 1, 1, 1, NULL),
				('resourceupdate', 'XenResource Update', X'416464696E6720616E2075706461746520746F20612058656E5265736F75726365207265736F757263652E', 1, 0, '', 0, '', 'share', 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL),
				('resourceupload', 'XenResource Upload', X'55706C6F6164696E672061206E65772058656E5265736F75726365207265736F757263652E204D756C7469706C6965722069732066696C6573697A652E', 1, 1, 'Bytes|Byte', 0, '', 'share', 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL)
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `active` = '1' WHERE `eventtriggerid` IN('transfer')
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `title` = 'Visit' WHERE `eventtriggerid` = 'visit'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `title` = 'Profile' WHERE `eventtriggerid` = 'profile'
		");
	}
	
	/**
	 *
	 */
	public function upgrade20160329Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_eventtrigger', function(Alter $table)
		{
			$table->addColumn('charge', 'tinyint')->setDefault(1)->after('rebuild');
			$table->addColumn('usergroups', 'tinyint')->setDefault(1)->after('charge');
		});
		
		$sm->alterTable('xf_user', function(Alter $table)
		{
			$table->addColumn('dbtech_credits_lastinterest', 'int')->setDefault(0)->after('dbtech_credits_lastdaily');
			$table->addColumn('dbtech_credits_lastpaycheck', 'int')->setDefault(0)->after('dbtech_credits_lastinterest');
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160329Step2()
	{
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger` (`eventtriggerid`, `title`, `description`, `active`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `charge`, `usergroups`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('registration', 'Registration', X'41206E6577207573657220726567697374657273206F6E2074686520666F72756D2E', 1, 0, '', 0, '', 'accounts', 1, 0, 0, 0, 0, 0, 0, '', 1, 1, 1, NULL)
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `active` = '1' WHERE `eventtriggerid` IN('transfer', 'interest', 'paycheck')
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `category` = 'time' WHERE `eventtriggerid` = 'interest'
		");
	}
	
	/**
	 *
	 */
	public function upgrade20160402Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_eventtrigger', function(Alter $table)
		{
			$table->changeColumn('referformat', 'varchar', 255)->setDefault('');
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160402Step2()
	{
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger` (`eventtriggerid`, `title`, `description`, `active`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `charge`, `usergroups`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('trophy', 'Trophy', X'4265696E6720617761726465642061206E65772074726F7068792E', 1, 0, '', 0, '', 'accounts', 1, 0, 0, 1, 1, 1, 0, '', 1, 1, 1, NULL);
		");
	}
	
	/**
	 *
	 */
	public function upgrade20160410Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_eventtrigger', function(Alter $table)
		{
			$table->changeColumn('parent', 'varchar', 255)->setDefault('');
			$table->changeColumn('category', 'varchar', 255)->setDefault('');
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160416Step1()
	{
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `active` = '1'
				WHERE `eventtriggerid` IN('punish')
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `cancel` = '1'
				WHERE `eventtriggerid` IN('punish', 'warning')
		");
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160518Step1()
	{
		$this->query("
			UPDATE xf_dbtech_credits_eventtrigger
				SET title = REPLACE(title, 'XenGallery', 'MediaGallery')
		");
		
		$this->query("
			UPDATE xf_dbtech_credits_eventtrigger
				SET description = REPLACE(description, 'XenGallery', 'MediaGallery')
		");
		
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger` (`eventtriggerid`, `title`, `description`, `active`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `charge`, `usergroups`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('xengallerycomment', 'XenGallery Comment', X'416464696E67206120636F6D6D656E7420746F20612058656E47616C6C657279206D65646961207265736F757263652E', 1, 2, '', 0, 'Media', 'discuss', 1, 1, 1, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, NULL),
				('xengallerycommented', 'XenGallery Commented', X'536F6D656F6E6520656C736520636F6D6D656E74696E67206F6E20796F75722058656E47616C6C657279206D65646961207265736F757263652E', 1, 2, '', 0, '', 'discuss', 1, 1, 0, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, NULL),
				('xengallerydownload', 'XenGallery Download', X'446F776E6C6F6164696E672058656E47616C6C657279206D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 1, 'Bytes|Byte', 0, 'Media', 'share', 1, 0, 1, 0, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL),
				('xengallerydownloaded', 'XenGallery Downloaded', X'536F6D656F6E6520656C736520646F776E6C6F6164696E6720796F75722058656E47616C6C657279206D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 1, 'Bytes|Byte', 0, '', 'share', 1, 0, 0, 0, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL),
				('xengalleryrate', 'XenGallery Rate', X'526174696E672058656E47616C6C657279206D656469612E204D756C7469706C69657220697320726174696E672E', 1, 1, 'Stars|Star', 0, 'Media', 'opinion', 1, 1, 1, 0, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, NULL),
				('xengalleryrated', 'XenGallery Rated', X'536F6D656F6E6520656C736520726174656420796F75722058656E47616C6C657279206D656469612E204D756C7469706C69657220697320726174696E672E', 1, 1, 'Stars|Star', 0, '', 'opinion', 1, 1, 0, 0, 1, 1, 0, 'showthread.php?t=', 1, 1, 1, NULL),
				('xengalleryupload', 'XenGallery Upload', X'55706C6F6164696E67206E65772058656E47616C6C657279204D656469612E204D756C7469706C6965722069732066696C6573697A652E', 1, 1, 'Bytes|Byte', 0, '', 'share', 1, 1, 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL)
		");
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160608Step1()
	{
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger` (`eventtriggerid`, `title`, `description`, `active`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `charge`, `usergroups`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('avatar', 'Upload Avatar', X'55706C6F6164696E672061206E6577206176617461722E204D756C7469706C6965722069732066696C6573697A652E', 1, 0, '', 0, '', 'accounts', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, NULL),
				('report', 'Report', X'5265706F7274696E672061207069656365206F6620636F6E74656E7420746F20746865206D6F64657261746F72732E', 1, 0, '', 0, '', 'behave', 1, 0, 1, 1, 1, 1, 0, '', 1, 1, 1, NULL),
				('reported', 'Reported', X'596F757220636F6E74656E7420776173207265706F7274656420746F20746865206D6F64657261746F72732E', 1, 0, '', 0, '', 'behave', 1, 0, 1, 1, 1, 1, 0, '', 1, 1, 1, NULL)
		");
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20160618Step1()
	{
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger` (`eventtriggerid`, `title`, `description`, `active`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `charge`, `usergroups`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('targetbet', 'Sportsbook Bet Challenge', X'4372656174696E67206120626574206368616C6C656E6765207769746820616E6F74686572206D656D626572', 1, 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, NULL),
				('targetbetaccept', 'Sportsbook Bet Challenge Accept', X'416363657074696E67206120626574206368616C6C656E6765', 1, 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, NULL),
				('targetbetaccepted', 'Sportsbook Bet Challenge Accepted', X'536F6D656F6E6520616363657074696E6720796F757220626574206368616C6C656E6765', 1, 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, NULL),
				('openbet', 'Sportsbook Open Bet', X'4372656174696E6720616E206F70656E20626574', 1, 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, NULL),
				('openbetaccept', 'Sportsbook Open Bet Accept', X'416363657074696E6720616E206F70656E20626574', 1, 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, NULL),
				('openbetaccepted', 'Sportsbook Open Bet Accepted', X'536F6D656F6E6520616363657074696E6720796F7572206F70656E20626574', 1, 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, NULL),
				('wager', 'Sportsbook Wager', X'506C6163696E672061207761676572206F6E20616E206576656E74', 1, 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, NULL),
				('wagered', 'Sportsbook Wagered', X'536F6D656F6E6520706C616365642061207761676572206F6E20796F7572206576656E74', 1, 0, '', 0, '', 'sportsbook', 1, 1, 1, 0, 1, 1, 0, '', 1, 1, 1, NULL)
		");
	}
	
	/**
	 *
	 */
	public function upgrade20160922Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_language', function(Alter $table)
		{
			$table->addColumn('dbtech_credits_phrase_cache', 'mediumblob')->nullable(true)->after('phrase_cache');
		});
	}
	
	
	public function upgrade20160928Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_currency', function(Alter $table)
		{
			$table->addColumn('displaycurrency', 'tinyint')->setDefault(0)->after('suffix');
		});
	}
	
	/**
	 *
	 */
	public function upgrade20161007Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->createTable('xf_dbtech_credits_purchase_transaction', function(Create $table)
		{
			$table->addColumn('transaction_id', 'int')->autoIncrement();
			$table->addColumn('eventid', 'int')->setDefault(0);
			$table->addColumn('fromuserid', 'int')->setDefault(0);
			$table->addColumn('touserid', 'int')->setDefault(0);
			$table->addColumn('ipaddress', 'varchar', 45)->setDefault('');
			$table->addColumn('amount', 'double', '10,2')->setDefault('0.00');
			$table->addColumn('cost', 'double', '10,2')->setDefault('0.00');
			$table->addColumn('currencyid', 'char', 3)->setDefault('');
			$table->addColumn('message', 'blob')->nullable(true);
			$table->addKey('eventid');
			$table->addKey('fromuserid');
			$table->addKey('touserid');
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20161019Step1()
	{
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger` (`eventtriggerid`, `title`, `description`, `active`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `charge`, `usergroups`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('registration', 'Registration', X'41206E6577207573657220726567697374657273206F6E2074686520666F72756D2E', 1, 0, '', 0, '', 'accounts', 1, 0, 0, 0, 0, 0, 0, '', 1, 1, 1, NULL)
		");
	}
	
	/**
	 *
	 */
	public function upgrade20161101Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_eventtrigger', function(Alter $table)
		{
			$table->addColumn('callback_class', 'varchar', 75)->setDefault('')->after('active');
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20161101Step2()
	{
		foreach ([
					 'adjust' 							=> 'DBTech_Credits_Model_Event_Adjust',
					 'avatar' 							=> 'DBTech_Credits_Model_Event_Avatar',
					 'birthday' 						=> 'DBTech_Credits_Model_Event_Birthday',
					 'content' 							=> 'DBTech_Credits_Model_Event_Content',
					 'daily' 							=> 'DBTech_Credits_Model_Event_Daily',
					 'dbtech_donate_donate' 			=> 'DBTech_Donate_Credits_Event_Donate',
					 'dbtech_shop_bankdeposit' 			=> 'DBTech_Shop_Credits_Event_BankDeposit',
					 'dbtech_shop_bankwithdraw' 		=> 'DBTech_Shop_Credits_Event_BankWithdraw',
					 'dbtech_shop_lotterybuyticket' 	=> 'DBTech_Shop_Credits_Event_LotteryBuyTicket',
					 'dbtech_shop_lotterypayout' 		=> 'DBTech_Shop_Credits_Event_LotteryPayOut',
					 'dbtech_shop_newreply' 			=> 'DBTech_Shop_Credits_Event_NewReply',
					 'dbtech_shop_newthread' 			=> 'DBTech_Shop_Credits_Event_NewThread',
					 'dbtech_shop_pointsadjust' 		=> 'DBTech_Shop_Credits_Event_PointsAdjust',
					 'dbtech_shop_sale' 				=> 'DBTech_Shop_Credits_Event_Sale',
					 'dbtech_shop_salebeneficiary' 		=> 'DBTech_Shop_Credits_Event_SaleBeneficiary',
					 'dbtech_shop_saleowner' 			=> 'DBTech_Shop_Credits_Event_SaleOwner',
					 'dbtech_shop_sellback' 			=> 'DBTech_Shop_Credits_Event_SellBack',
					 'dbtech_shop_sellbackbeneficiary' 	=> 'DBTech_Shop_Credits_Event_SellBackBeneficiary',
					 'dbtech_shop_sellbackowner' 		=> 'DBTech_Shop_Credits_Event_SellBackOwner',
					 'dbtech_shop_stealfail' 			=> 'DBTech_Shop_Credits_Event_StealFail',
					 'dbtech_shop_stealsuccess' 		=> 'DBTech_Shop_Credits_Event_StealSuccess',
					 'dbtech_shop_trade' 				=> 'DBTech_Shop_Credits_Event_Trade',
					 'donate' 							=> 'DBTech_Credits_Model_Event_Donate',
					 'download' 						=> 'DBTech_Credits_Model_Event_Download',
					 'downloaded' 						=> 'DBTech_Credits_Model_Event_Downloaded',
					 'follow' 							=> 'DBTech_Credits_Model_Event_Follow',
					 'followed' 						=> 'DBTech_Credits_Model_Event_Followed',
					 'gallerycomment' 					=> 'DBTech_Credits_Model_Event_Gallerycomment',
					 'gallerycommented' 				=> 'DBTech_Credits_Model_Event_Gallerycommented',
					 'gallerydownload' 					=> 'DBTech_Credits_Model_Event_Gallerydownload',
					 'gallerydownloaded' 				=> 'DBTech_Credits_Model_Event_Gallerydownloaded',
					 'galleryrate' 						=> 'DBTech_Credits_Model_Event_Galleryrate',
					 'galleryrated' 					=> 'DBTech_Credits_Model_Event_Galleryrated',
					 'galleryupload' 					=> 'DBTech_Credits_Model_Event_Galleryupload',
					 'interest' 						=> 'DBTech_Credits_Model_Event_Interest',
					 'like' 							=> 'DBTech_Credits_Model_Event_Like',
					 'liked' 							=> 'DBTech_Credits_Model_Event_Liked',
					 'message' 							=> 'DBTech_Credits_Model_Event_Message',
					 'openbet' 							=> 'DBTech_Credits_Model_Event_SportsBook_OpenBet',
					 'openbetaccept' 					=> 'DBTech_Credits_Model_Event_SportsBook_OpenBetAccept',
					 'openbetaccepted' 					=> 'DBTech_Credits_Model_Event_SportsBook_OpenBetAccepted',
					 'paycheck' 						=> 'DBTech_Credits_Model_Event_Paycheck',
					 'poll' 							=> 'DBTech_Credits_Model_Event_Poll',
					 'post' 							=> 'DBTech_Credits_Model_Event_Post',
					 'postrate' 						=> 'DBTech_Credits_Model_Event_PostRate',
					 'postrated' 						=> 'DBTech_Credits_Model_Event_PostRated',
					 'profile' 							=> 'DBTech_Credits_Model_Event_Profile',
					 'punish' 							=> 'DBTech_Credits_Model_Event_Punish',
					 'purchase' 						=> 'DBTech_Credits_Model_Event_Purchase',
					 'read' 							=> 'DBTech_Credits_Model_Event_Read',
					 'redeem' 							=> 'DBTech_Credits_Model_Event_Redeem',
					 'registration' 					=> 'DBTech_Credits_Model_Event_Registration',
					 'reply' 							=> 'DBTech_Credits_Model_Event_Reply',
					 'report' 							=> 'DBTech_Credits_Model_Event_Report',
					 'reported' 						=> 'DBTech_Credits_Model_Event_Reported',
					 'resourcedownload' 				=> 'DBTech_Credits_Model_Event_ResourceDownload',
					 'resourcedownloaded' 				=> 'DBTech_Credits_Model_Event_ResourceDownloaded',
					 'resourcerate' 					=> 'DBTech_Credits_Model_Event_ResourceRate',
					 'resourcerated' 					=> 'DBTech_Credits_Model_Event_ResourceRated',
					 'resourceupdate' 					=> 'DBTech_Credits_Model_Event_ResourceUpdate',
					 'resourceupload' 					=> 'DBTech_Credits_Model_Event_ResourceUpload',
					 'revival' 							=> 'DBTech_Credits_Model_Event_Revival',
					 'sticky' 							=> 'DBTech_Credits_Model_Event_Sticky',
					 'tag' 								=> 'DBTech_Credits_Model_Event_Tag',
					 'targetbet' 						=> 'DBTech_Credits_Model_Event_SportsBook_TargetBet',
					 'targetbetaccept' 					=> 'DBTech_Credits_Model_Event_SportsBook_TargetBetAccept',
					 'targetbetaccepted' 				=> 'DBTech_Credits_Model_Event_SportsBook_TargetBetAccepted',
					 'thread' 							=> 'DBTech_Credits_Model_Event_Thread',
					 'transfer' 						=> 'DBTech_Credits_Model_Event_Transfer',
					 'trophy' 							=> 'DBTech_Credits_Model_Event_Trophy',
					 'upload' 							=> 'DBTech_Credits_Model_Event_Upload',
					 'view' 							=> 'DBTech_Credits_Model_Event_View',
					 'visit' 							=> 'DBTech_Credits_Model_Event_Visit',
					 'visitor' 							=> 'DBTech_Credits_Model_Event_Visitor',
					 'vote' 							=> 'DBTech_Credits_Model_Event_Vote',
					 'wager' 							=> 'DBTech_Credits_Model_Event_SportsBook_Wager',
					 'wagered' 							=> 'DBTech_Credits_Model_Event_SportsBook_Wagered',
					 'wall' 							=> 'DBTech_Credits_Model_Event_Wall',
					 'warning' 							=> 'DBTech_Credits_Model_Event_Warning',
					 'xengallerycomment' 				=> 'DBTech_Credits_Model_Event_XenGalleryComment',
					 'xengallerycommented' 				=> 'DBTech_Credits_Model_Event_XenGalleryCommented',
					 'xengallerydownload' 				=> 'DBTech_Credits_Model_Event_XenGalleryDownload',
					 'xengallerydownloaded' 			=> 'DBTech_Credits_Model_Event_XenGalleryDownloaded',
					 'xengalleryrate' 					=> 'DBTech_Credits_Model_Event_XenGalleryRate',
					 'xengalleryrated' 					=> 'DBTech_Credits_Model_Event_XenGalleryRated',
					 'xengalleryupload' 				=> 'DBTech_Credits_Model_Event_XenGalleryUpload',
				 ] as $eventTriggerId => $callbackClass)
		{
			$this->query("
				UPDATE `xf_dbtech_credits_eventtrigger`
					SET `callback_class` = '$callbackClass'
					WHERE `eventtriggerid` = '$eventTriggerId'
			");
		}
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20161103Step1()
	{
		foreach ([
					 'dbtech_shop_salebeneficiary',
					 'dbtech_shop_saleowner',
					 'dbtech_shop_sellbackbeneficiary',
					 'dbtech_shop_sellbackowner',
					 'dbtech_shop_trade',
				 ] as $eventTriggerId)
		{
			$this->query("
				UPDATE `xf_dbtech_credits_eventtrigger`
					SET `rebuild` = 0
					WHERE `eventtriggerid` = '$eventTriggerId'
			");
		}
	}
	
	/**
	 *
	 */
	public function upgrade20161111Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_user', function(Alter $table)
		{
			$table->addColumn('dbtech_credits_lasttaxation', 'int')->setDefault(0)->after('dbtech_credits_lastpaycheck');
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20161111Step2()
	{
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger` (`eventtriggerid`, `title`, `description`, `active`, `callback_class`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `charge`, `usergroups`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('taxation', 'Taxation', X'4175746F6D61746963616C6C7920746178206D656D62657273272063757272656E63696573206F7665722074696D652E', 1, 'DBTech_Credits_Model_Event_Taxation', 1, 'Currency|Currency', 0, '', 'time', 1, 0, 0, 0, 1, 1, 0, '', 1, 1, 1, X'613A323A7B733A31373A227461786174696F6E5F696E74657276616C223B733A323A223330223B733A31343A227461786174696F6E5F7374617274223B733A31303A22323030392D31322D3235223B7D')
		");
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20161115Step1()
	{
		foreach ([
					 'dbtech_shop_salebeneficiary',
					 'dbtech_shop_saleowner',
					 'dbtech_shop_sellbackbeneficiary',
					 'dbtech_shop_sellbackowner',
					 'dbtech_shop_trade',
			
					 // Make sure this is updated
					 'adjust',
					 'content',
					 'daily',
					 'donate',
					 'download',
					 'downloaded',
					 'gallerydownload',
					 'gallerydownloaded',
					 'interest',
					 'openbet',
					 'openbetaccept',
					 'openbetaccepted',
					 'profile',
					 'read',
					 'redeem',
					 'resourcedownload',
					 'resourcedownloaded',
					 'revival',
					 'targetbet',
					 'targetbetaccept',
					 'targetbetaccepted',
					 'taxation',
					 'transfer',
					 'view',
					 'visit',
					 'wager',
					 'wagered',
					 'xengallerydownload',
					 'xengallerydownloaded',
					 'xengalleryrate',
					 'xengalleryrated',
				 ] as $eventTriggerId)
		{
			$this->query("
				UPDATE `xf_dbtech_credits_eventtrigger`
					SET `rebuild` = 0
					WHERE `eventtriggerid` = '$eventTriggerId'
			");
		}
		
		foreach ([
					 'avatar',
					 'galleryrate',
					 'galleryrated',
					 'purchase',
					 'registration',
					 'resourcerate',
					 'resourcerated',
					 'sticky',
				 ] as $eventTriggerId)
		{
			$this->query("
				UPDATE `xf_dbtech_credits_eventtrigger`
					SET `rebuild` = 1
					WHERE `eventtriggerid` = '$eventTriggerId'
			");
		}
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20161129Step1()
	{
		$this->query("
			INSERT IGNORE INTO `xf_dbtech_credits_eventtrigger`
				(`eventtriggerid`, `title`, `description`, `active`, `callback_class`, `multiplier`, `multiplier_label`, `multiplier_popup`, `parent`, `category`, `global`, `revert`, `cancel`, `rebuild`, `charge`, `usergroups`, `currency`, `referformat`, `outbound`, `inbound`, `value`, `settings`)
			VALUES
				('xenmediocomment', 'XenMedio Comment', X'416464696E67206120636F6D6D656E7420746F20612058656E4D6564696F206D65646961207265736F757263652E', 1, 'DBTech_Credits_Model_Event_XenMedio_Comment', 2, '', 0, 'Media', 'discuss', 1, 1, 1, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, NULL),
				('xenmediocommented', 'XenMedio Commented', X'536F6D656F6E6520656C736520636F6D6D656E74696E67206F6E20796F75722058656E4D6564696F206D65646961207265736F757263652E', 1, 'DBTech_Credits_Model_Event_XenMedio_Commented', 2, '', 0, '', 'discuss', 1, 1, 0, 1, 1, 1, 0, 'showpost.php?p=', 1, 1, 1, NULL),
				('xenmedioupload', 'XenMedio Upload', X'416464696E67206E65772058656E4D6564696F204D656469612E', 1, 'DBTech_Credits_Model_Event_XenMedio_Upload', 0, '', 0, '', 'share', 1, 1, 1, 1, 1, 1, 0, 'attachment.php?attachmentid=', 1, 1, 1, NULL)
		");
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20170314Step1()
	{
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = REPLACE(`callback_class`, 'Event_XenGallery', 'Event_SonnbGallery_')
				WHERE `eventtriggerid` LIKE 'xengallery%'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = REPLACE(`callback_class`, 'Event_XenMedio', 'Event_JaxelMedio')
				WHERE `eventtriggerid` LIKE 'xenmedio%'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = REPLACE(`callback_class`, 'Event_PostRate', 'Event_PostRating_Rate')
				WHERE `eventtriggerid` LIKE 'postrate%'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Download'
				WHERE `eventtriggerid` = 'resourcedownload'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Downloaded'
				WHERE `eventtriggerid` = 'resourcedownloaded'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Rate'
				WHERE `eventtriggerid` = 'resourcerate'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Rated'
				WHERE `eventtriggerid` = 'resourcerated'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Update'
				WHERE `eventtriggerid` = 'resourceupdate'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Upload'
				WHERE `eventtriggerid` = 'resourceupload'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Comment'
				WHERE `eventtriggerid` = 'gallerycomment'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Commented'
				WHERE `eventtriggerid` = 'gallerycommented'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Download'
				WHERE `eventtriggerid` = 'gallerydownload'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Downloaded'
				WHERE `eventtriggerid` = 'gallerydownloaded'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Rate'
				WHERE `eventtriggerid` = 'galleryrate'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Rated'
				WHERE `eventtriggerid` = 'galleryrated'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Upload'
				WHERE `eventtriggerid` = 'galleryupload'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = REPLACE(`callback_class`, '_', '\\\')
				WHERE `callback_class` LIKE 'DBTech_Credits_%'
		");
		
		$eventTriggers = $this->db()->fetchPairs('SELECT eventtriggerid, settings FROM xf_dbtech_credits_eventtrigger');
		foreach ($eventTriggers as $eventTriggerId => $settings)
		{
			if ($settings === NULL)
			{
				$settings = [];
			}
			else
			{
				$settings = @unserialize($settings);
				$settings = is_array($settings) ? $settings : [];
			}
			
			$this->db()->update('xf_dbtech_credits_eventtrigger', [
				'settings' => json_encode($settings)
			], 'eventtriggerid = ' . $this->db()->quote($eventTriggerId));
		}
		
		// Purge the cache
		\XF::registry()->delete([
			'dbt_credits_eventtrigger',
		]);
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade20170426Step1()
	{
		foreach ([
					 'postrate',
					 'postrated',
				 ] as $eventTriggerId)
		{
			$this->query("
				UPDATE `xf_dbtech_credits_eventtrigger`
					SET `cancel` = 1
					WHERE `eventtriggerid` = '$eventTriggerId'
			");
		}
	}
	
	/**
	 *
	 */
	public function upgrade20170504Step1()
	{
		$items = $this->db()->fetchAll('SELECT * FROM xf_dbtech_credits_event');
		foreach ($items as $item)
		{
			$jsonArray = [
				'usergroups' => '',
				'forums' => '',
				'settings' => ''
			];
			foreach ($jsonArray as $key => $data)
			{
				if ($item[$key] === NULL)
				{
					$item[$key] = [];
				}
				else
				{
					$item[$key] = @unserialize($item[$key]);
					$item[$key] = is_array($item[$key]) ? $item[$key] : [];
				}
				
				$jsonArray[$key] = json_encode($item[$key]);
			}
			
			$this->db()->update('xf_dbtech_credits_event', $jsonArray, 'eventid = ' . $this->db()->quote($item['eventid']));
		}
		
		// Purge the cache
		\XF::registry()->delete([
			'dbt_credits_event',
		]);
	}
	
	/**
	 *
	 */
	public function upgrade805000031Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_currency', function(Alter $table)
		{
			$table->addColumn('sidebar', 'tinyint')->setDefault(1);
		});
	}
	
	/**
	 *
	 */
	public function upgrade905000031Step1()
	{
		$this->insertNamedWidget('dbtech_credits_wallet');
		$this->insertNamedWidget('dbtech_credits_richest');
		
		// Purge the cache of both possible copies of this
		\XF::registry()->delete([
			'dbt_credits_currency',
			'dbt_credits_event',
			'dbt_credits_eventtrigger',
			'dbt_credits_field',
			
			'dbtech_credits_currency',
			'dbtech_credits_event',
			'dbtech_credits_eventtrigger',
			'dbtech_credits_field',
		]);
	}
	
	/**
	 *
	 */
	public function upgrade905000032Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_eventtrigger', function(Alter $table)
		{
			$table->changeColumn('eventtriggerid', 'varbinary');
		});
		
		$sm->alterTable('xf_dbtech_credits_currency', function(Alter $table)
		{
			$table->addColumn('postbit', 'tinyint')->setDefault(1);
		});
		
		$sm->alterTable('xf_dbtech_credits_event', function(Alter $table)
		{
			$table->addColumn('title', 'varchar', 255)->setDefault('')->after('eventid');
			$table->addColumn('display', 'tinyint', 3)->setDefault(1)->after('alert');
		});
		
		// Purge the cache of both possible copies of this
		\XF::registry()->delete([
			'dbt_credits_event',
			'dbt_credits_eventtrigger',
		]);
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade905000033Step1()
	{
		$this->query("
			REPLACE INTO `xf_purchasable`
				(`purchasable_type_id`, `purchasable_class`, `addon_id`)
			VALUES
				('dbtech_credits_currency', 'DBTech\\\\Credits\\\\XF:Currency', X'4442546563682F43726564697473')
		");
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade905000039Step1()
	{
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = REPLACE(`callback_class`, 'Event_XenGallery', 'Event_SonnbGallery_')
				WHERE `eventtriggerid` LIKE 'xengallery%'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = REPLACE(`callback_class`, 'Event_XenMedio', 'Event_JaxelMedio')
				WHERE `eventtriggerid` LIKE 'xenmedio%'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = REPLACE(`callback_class`, 'Event_PostRate', 'Event_PostRating_Rate')
				WHERE `eventtriggerid` LIKE 'postrate%'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Download'
				WHERE `eventtriggerid` = 'resourcedownload'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Downloaded'
				WHERE `eventtriggerid` = 'resourcedownloaded'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Rate'
				WHERE `eventtriggerid` = 'resourcerate'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Rated'
				WHERE `eventtriggerid` = 'resourcerated'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Update'
				WHERE `eventtriggerid` = 'resourceupdate'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Resource_Upload'
				WHERE `eventtriggerid` = 'resourceupload'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Comment'
				WHERE `eventtriggerid` = 'gallerycomment'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Commented'
				WHERE `eventtriggerid` = 'gallerycommented'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Download'
				WHERE `eventtriggerid` = 'gallerydownload'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Downloaded'
				WHERE `eventtriggerid` = 'gallerydownloaded'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Rate'
				WHERE `eventtriggerid` = 'galleryrate'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Rated'
				WHERE `eventtriggerid` = 'galleryrated'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = 'DBTech_Credits_Model_Event_Gallery_Upload'
				WHERE `eventtriggerid` = 'galleryupload'
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_eventtrigger`
				SET `callback_class` = REPLACE(`callback_class`, '_', '\\\')
				WHERE `callback_class` LIKE 'DBTech_Credits_%'
		");
		
		// Purge the cache
		\XF::registry()->delete([
			'dbt_credits_eventtrigger',
		]);
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade905000370Step1()
	{
		foreach ([
					 'punish',
					 'warning',
				 ] as $eventTriggerId)
		{
			$this->query("
				UPDATE `xf_dbtech_credits_eventtrigger`
					SET `cancel` = 0
					WHERE `eventtriggerid` = '$eventTriggerId'
			");
		}
		
		// Purge the cache of both possible copies of this
		\XF::registry()->delete([
			'dbt_credits_eventtrigger',
		]);
	}
	
	/**
	 *
	 */
	public function upgrade905010031Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->renameTable('xf_dbtech_credits_eventtrigger', 'xf_dbtech_credits_event_trigger');
	}
	
	/**
	 *
	 */
	public function upgrade905010031Step2()
	{
		$sm = $this->schemaManager();
		
		$sm->dropTable('xf_dbtech_credits_field');
		$sm->dropTable('xf_dbtech_credits_purchase_log');
		$sm->dropTable('xf_dbtech_credits_transaction_pending');
		
		$sm->alterTable('xf_dbtech_credits_transaction', function(Alter $table)
		{
			$table->addColumn('content_type', 'varbinary', 25)->after('referenceid');
			$table->addColumn('content_id', 'int')->after('content_type');
		});
		
		$sm->alterTable('xf_dbtech_credits_purchase_transaction', function(Alter $table)
		{
			$table->addColumn('ip_id', 'int', 10)->setDefault(0)->after('touserid');
			$table->dropColumns(['ipaddress']);
		});
	}
	
	/**
	 *
	 */
	public function upgrade905010031Step3()
	{
		$sm = $this->schemaManager();
		
		$columns = $sm->getTableColumnDefinitions('xf_user');
		
		if (array_key_exists('dbtech_credits_credits', $columns))
		{
			$sm->alterTable('xf_user', function(Alter $table)
			{
				// Column was changed but not blacklisted so rename the column
				$table->changeColumn('dbtech_credits_credits', 'double')->unsigned(false)->setDefault('0');
			});
		}
	}
	
	/**
	 *
	 */
	public function upgrade905010031Step4()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_charge', function(Alter $table)
		{
			$table->renameColumn('postid', 'post_id');
			$table->renameColumn('contenthash', 'content_hash');
		});
		
		$sm->alterTable('xf_dbtech_credits_charge_purchase', function(Alter $table)
		{
			$table->renameColumn('postid', 'post_id');
			$table->renameColumn('contenthash', 'content_hash');
			$table->renameColumn('userid', 'user_id');
		});
		
		$sm->alterTable('xf_dbtech_credits_currency', function(Alter $table)
		{
			$table->renameColumn('currencyid', 'currency_id');
			$table->renameColumn('displayorder', 'display_order');
			$table->renameColumn('useprefix', 'use_table_prefix');
			$table->renameColumn('userid', 'use_user_id');
			$table->renameColumn('usercol', 'user_id_column');
			$table->renameColumn('displaycurrency', 'is_display_currency');
		});
	}
	
	/**
	 *
	 */
	public function upgrade905010031Step5()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_event', function(Alter $table)
		{
			$table->renameColumn('eventid', 'event_id');
			$table->renameColumn('currencyid', 'currency_id');
			$table->renameColumn('eventtriggerid', 'event_trigger_id');
			$table->renameColumn('usergroups', 'user_group_ids');
			$table->renameColumn('forums', 'node_ids');
		});
		
		$sm->alterTable('xf_dbtech_credits_event_trigger', function(Alter $table)
		{
			$table->renameColumn('eventtriggerid', 'event_trigger_id');
		});
		
		$sm->alterTable('xf_dbtech_credits_purchase_transaction', function(Alter $table)
		{
			$table->renameColumn('eventid', 'event_id');
			$table->renameColumn('fromuserid', 'from_user_id');
			$table->renameColumn('touserid', 'to_user_id');
			$table->renameColumn('currencyid', 'currency_id');
		});
	}
	
	/**
	 *
	 */
	public function upgrade905010031Step6()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_transaction', function(Alter $table)
		{
			$table->renameColumn('transactionid', 'transaction_id');
			$table->renameColumn('eventid', 'event_id');
			$table->renameColumn('eventtriggerid', 'event_trigger_id');
			$table->renameColumn('userid', 'user_id');
			$table->renameColumn('sourceuserid', 'source_user_id');
			$table->renameColumn('referenceid', 'reference_id');
			$table->renameColumn('forumid', 'node_id');
			$table->renameColumn('ownerid', 'owner_id');
			$table->renameColumn('currencyid', 'currency_id');
			$table->renameColumn('isdisputed', 'is_disputed');
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade905010031Step7()
	{
		$this->query("
			REPLACE INTO `xf_purchasable`
				(`purchasable_type_id`, `purchasable_class`, `addon_id`)
			VALUES
				('dbtech_credits_currency', 'DBTech\\\\Credits:Currency', X'4442546563682F43726564697473')
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_event`
			SET `user_group_ids` = '[-1]'
			WHERE `user_group_ids` = '[]'
				OR `user_group_ids` = ''
		");
		
		$this->query("
			UPDATE `xf_dbtech_credits_event`
			SET `node_ids` = '[-1]'
			WHERE `node_ids` = '[]'
				OR `node_ids` = ''
		");
	}
	
	/**
	 *
	 */
	public function upgrade905010033Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_currency', function(Alter $table)
		{
			$table->addColumn('member_dropdown', 'tinyint')->setDefault(0);
		});
		
		\XF::registry()->delete([
			'dbtCreditsCurrencies',
		]);
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade905030031Step1()
	{
		$db = $this->db();
		
		$db->beginTransaction();
		
		$this->renamePermission('dbtech_credits', 'canview', 'dbtechCredits', 'view');
		$this->renamePermission('dbtech_credits', 'triggerEvents', 'dbtechCredits', 'triggerEvents');
		$this->renamePermission('dbtech_credits', 'charge', 'dbtechCredits', 'charge');
		
		$this->renamePermission('dbtech_credits', 'adjust', 'dbtechCredits', 'adjust');
		$this->renamePermission('dbtech_credits', 'viewlog', 'dbtechCredits', 'viewAnyLog');
		$this->renamePermission('dbtech_credits', 'special', 'dbtechCredits', 'bypassCurrencyPrivacy');
		$this->renamePermission('dbtech_credits', 'bypassChargeTag', 'dbtechCredits', 'bypassChargeTag');
	}
	
	/**
	 *
	 */
	public function upgrade905030031Step2()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_currency', function(Alter $table)
		{
			$table->addKey('active');
		});
		
		$sm->alterTable('xf_dbtech_credits_event', function(Alter $table)
		{
			$table->addKey(['active', 'display'], 'transaction_display');
		});
		
		$sm->alterTable('xf_dbtech_credits_purchase_transaction', function(Alter $table)
		{
			$table->renameColumn('to_user_id', 'user_id');
			$table->addColumn('transaction_date', 'int', 10)->setDefault(0)->after('user_id');
			$table->addKey(['transaction_date', 'user_id'], 'transaction_date');
		});
		
		$sm->alterTable('xf_dbtech_credits_transaction', function(Alter $table)
		{
			$table->addKey(['dateline', 'transaction_id'], 'transaction_date');
		});
	}
	
	/**
	 *
	 */
	public function upgrade905030031Step3()
	{
		$sm = $this->schemaManager();
		
		$tables = $this->getTables();
		
		$key = 'xf_dbtech_credits_adjust_log';
		$sm->createTable($key, $tables[$key]);
		
		$key = 'xf_dbtech_credits_donation_log';
		$sm->createTable($key, $tables[$key]);
		
		$key = 'xf_dbtech_credits_redeem_log';
		$sm->createTable($key, $tables[$key]);
		
		$key = 'xf_dbtech_credits_transfer_log';
		$sm->createTable($key, $tables[$key]);
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade905030031Step4()
	{
		$this->executeUpgradeQuery("
			INSERT INTO xf_dbtech_credits_adjust_log
				(user_id, adjust_date, adjust_user_id, event_id, currency_id, amount, message)
			SELECT user_id, dateline, source_user_id, event_id, currency_id, amount, message
			FROM xf_dbtech_credits_transaction
			WHERE event_trigger_id = 'adjust'
				AND status = 1
		");
		
		$this->executeUpgradeQuery("
			INSERT INTO xf_dbtech_credits_donation_log
				(user_id, donation_date, donation_user_id, event_id, currency_id, amount, message)
			SELECT user_id, dateline, source_user_id, event_id, currency_id, amount, message
			FROM xf_dbtech_credits_transaction
			WHERE event_trigger_id = 'donate'
				AND status = 1
		");
		
		$this->executeUpgradeQuery("
			INSERT INTO xf_dbtech_credits_purchase_transaction
				(user_id, transaction_date, from_user_id, event_id, currency_id, amount, message)
			SELECT user_id, dateline, source_user_id, event_id, currency_id, amount, message
			FROM xf_dbtech_credits_transaction
			WHERE event_trigger_id = 'purchase'
				AND status = 1
		");
		
		$this->executeUpgradeQuery("
			INSERT INTO xf_dbtech_credits_redeem_log
				(user_id, redeem_date, redeem_code, event_id, currency_id, amount, message)
			SELECT user_id, dateline, reference_id, event_id, currency_id, amount, message
			FROM xf_dbtech_credits_transaction
			WHERE event_trigger_id = 'redeem'
				AND status = 1
		");
		
		$this->executeUpgradeQuery("
			INSERT INTO xf_dbtech_credits_transfer_log
				(user_id, transfer_date, event_id, currency_id, amount, message)
			SELECT user_id, dateline, event_id, currency_id, amount, message
			FROM xf_dbtech_credits_transaction
			WHERE event_trigger_id = 'transfer'
				AND status = 1
		");
	}
	
	/**
	 *
	 */
	public function upgrade905030032Step1()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_dbtech_credits_purchase_transaction', function(Alter $table)
		{
			$table->renameColumn('to_user_id', 'user_id');
		});
	}
	
	/**
	 * @throws \XF\Db\Exception
	 */
	public function upgrade905030033Step1()
	{
		$defaultValue = [
			'enabled' => 1,
			'right_position' => false,
			'right_text' => true
		];
		
		$this->query("
			UPDATE xf_option
			SET default_value = ?
			WHERE option_id = 'dbtech_credits_navbar'
		", json_encode($defaultValue));
		
		$navbarDefaults = json_decode($this->db()->fetchOne("
			SELECT option_value
			FROM xf_option
			WHERE option_id = 'dbtech_credits_navbar'
		"), true);
		
		$update = false;
		foreach (array_keys($defaultValue) AS $key)
		{
			if (!isset($navbarDefaults[$key]))
			{
				$update = true;
				$navbarDefaults[$key] = $defaultValue[$key];
			}
		}
		
		if ($update)
		{
			$this->query("
				UPDATE xf_option
				SET option_value = ?
				WHERE option_id = 'dbtech_credits_navbar'
			", json_encode($navbarDefaults));
		}
	}
	
	
	/**
	 * @param $previousVersion
	 * @param array $stateChanges
	 */
	public function postUpgrade($previousVersion, array &$stateChanges)
	{
		if ($this->applyDefaultPermissions($previousVersion))
		{
			// since we're running this after data imports, we need to trigger a permission rebuild
			// if we changed anything
			$this->app->jobManager()->enqueueUnique(
				'permissionRebuild',
				'XF:PermissionRebuild',
				[],
				false
			);
		}
		
		// Upgrade to v5.1.0 Beta 1
		if ($previousVersion < 905010031)
		{
			$options = $this->db()->fetchPairs("
				SELECT option_id, option_value
				FROM xf_option
				WHERE option_id LIKE 'dbtech_credits_eventtrigger_%'
			");
			if (!count($options))
			{
				$stateChanges['redirect'] = \XF::app()->router('admin')
					->buildLink('dbtech-credits/upgrade-error')
				;
			}
			else
			{
				$newSettings = [];
				
				$eventTriggers = $this->db()->fetchPairs("
					SELECT event_trigger_id, settings
					FROM xf_dbtech_credits_event_trigger
					WHERE event_trigger_id IN(
						'content', 'donate', 'interest', 'message',
						'paycheck', 'purchase', 'revival', 'taxation'
					)
				");
				foreach ($eventTriggers as $eventTriggerId => $settings)
				{
					$settings = json_decode($settings, true);
					if (empty($settings))
					{
						continue;
					}
					
					foreach ($settings as $key => $val)
					{
						if (strpos($eventTriggerId, $key) === false)
						{
							// Work around an issue where every setting was saved for every event trigger
							// even if it didn't apply
							continue;
						}
						
						if (array_key_exists('dbtech_credits_eventtrigger_' . $key, $options))
						{
							$newSettings['dbtech_credits_eventtrigger_' . $key] = $val;
						}
					}
				}
				
				if (count($newSettings))
				{
					/** @var \XF\Repository\Option $optionRepo */
					$optionRepo = \XF::repository('XF:Option');
					$optionRepo->updateOptions($newSettings);
				}
			}
		}
		
		/** @var \DBTech\Credits\Repository\Currency $currencyRepo */
		$currencyRepo = \XF::repository('DBTech\Credits:Currency');
		$currencyRepo->rebuildCache();
	}
	
	
	// ################################ UNINSTALL ####################
	
	public function uninstallStep1()
	{
		$sm = $this->schemaManager();
		
		foreach (array_keys($this->getTables()) AS $tableName)
		{
			$sm->dropTable($tableName);
		}
		
		foreach ($this->getDefaultWidgetSetup() AS $widgetKey => $widgetFn)
		{
			$this->deleteWidget($widgetKey);
		}
	}
	
	public function uninstallStep2()
	{
		$sm = $this->schemaManager();
		
		$sm->alterTable('xf_user', function (Alter $table)
		{
			$table->dropColumns([
				'dbtech_credits_credits',
				'dbtech_credits_lastdaily',
				'dbtech_credits_lastinterest',
				'dbtech_credits_lastpaycheck',
				'dbtech_credits_lasttaxation',
			]);
		});
	}
	
	public function uninstallStep3()
	{
		$db = $this->db();
		
		$contentTypes = [
			'dbtech_credits'
		];
		$this->uninstallContentTypeData($contentTypes);
		
		$db->beginTransaction();
		
		// Get rid of change logs
		$db->delete('xf_change_log', "content_type LIKE 'dbtech_credits_%'");
		$db->delete('xf_change_log', "field LIKE 'dbtech_credits_%'");
		
		foreach ($this->getAdminPermissions() AS $permissionId)
		{
			$db->delete('xf_admin_permission_entry', "admin_permission_id = '$permissionId'");
		}
		
		$db->delete('xf_permission_entry', "permission_group_id = 'dbtechCredits'");
		$db->delete('xf_permission_entry', "permission_group_id = 'dbtechCreditsAdmin'");
		$db->delete('xf_permission_entry_content', "permission_group_id = 'dbtechCredits'");
		$db->delete('xf_permission_entry_content', "permission_group_id = 'dbtechCreditsAdmin'");
		
		$registryEntries = [
			'dbtCreditsCurrencies'
		];
		foreach ($registryEntries AS $entry)
		{
			try
			{
				\XF::registry()->delete($entry);
			}
			catch (\Exception $e) {}
		}
		
		$db->commit();
	}
	
	// ############################# TABLE / DATA DEFINITIONS ##############################
	
	/**
	 * @return array
	 */
	protected function getTables()
	{
		$tables = [];
		
		$tables['xf_dbtech_credits_adjust_log'] = function (Create $table)
		{
			$table->addColumn('adjust_log_id', 'int')->autoIncrement();
			$table->addColumn('user_id', 'int');
			$table->addColumn('adjust_date', 'int')->setDefault(0);
			$table->addColumn('adjust_user_id', 'int');
			$table->addColumn('event_id', 'int');
			$table->addColumn('currency_id', 'int');
			$table->addColumn('amount', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('message', 'blob')->nullable(true);
			$table->addKey(['adjust_date', 'user_id'], 'adjust_date');
			$table->addKey('user_id');
			$table->addKey('adjust_user_id');
		};
		
		$tables['xf_dbtech_credits_charge'] = function (Create $table)
		{
			$table->addColumn('post_id', 'int');
			$table->addColumn('content_hash', 'char', 32);
			$table->addColumn('cost', 'double')->unsigned(false)->setDefault(0);
			$table->addPrimaryKey(['post_id', 'content_hash']);
		};
		
		$tables['xf_dbtech_credits_charge_purchase'] = function (Create $table)
		{
			$table->addColumn('post_id', 'int');
			$table->addColumn('content_hash', 'char', 32);
			$table->addColumn('user_id', 'int');
			$table->addPrimaryKey(['post_id', 'content_hash', 'user_id']);
		};
		
		$tables['xf_dbtech_credits_currency'] = function (Create $table)
		{
			$table->addColumn('currency_id', 'int')->autoIncrement();
			$table->addColumn('title', 'varchar', 255)->setDefault('');
			$table->addColumn('description', 'blob')->nullable(true);
			$table->addColumn('active', 'tinyint')->setDefault(1);
			$table->addColumn('display_order', 'int')->setDefault(0);
			$table->addColumn('table', 'varchar', 255)->setDefault('');
			$table->addColumn('use_table_prefix', 'tinyint')->setDefault(1);
			$table->addColumn('column', 'varchar', 255)->setDefault('');
			$table->addColumn('use_user_id', 'tinyint')->setDefault(1);
			$table->addColumn('user_id_column', 'varchar', 255)->setDefault('user_id');
			$table->addColumn('decimals', 'tinyint', 2)->setDefault(0);
			$table->addColumn('privacy', 'tinyint')->setDefault(0);
			$table->addColumn('blacklist', 'tinyint')->setDefault(0);
			$table->addColumn('prefix', 'varchar', 50)->setDefault('');
			$table->addColumn('suffix', 'varchar', 50)->setDefault('');
			$table->addColumn('negative', 'tinyint')->setDefault(0);
			$table->addColumn('maxtime', 'int')->setDefault(0);
			$table->addColumn('earnmax', 'double')->setDefault(0);
			$table->addColumn('value', 'double')->unsigned(false)->setDefault(1);
			$table->addColumn('inbound', 'tinyint')->setDefault(1);
			$table->addColumn('outbound', 'tinyint')->setDefault(1);
			$table->addColumn('is_display_currency', 'tinyint')->setDefault(0);
			$table->addColumn('sidebar', 'tinyint')->setDefault(1);
			$table->addColumn('postbit', 'tinyint')->setDefault(1);
			$table->addColumn('member_dropdown', 'tinyint')->setDefault(0);
			$table->addKey('active');
		};
		
		$tables['xf_dbtech_credits_donation_log'] = function (Create $table)
		{
			$table->addColumn('donation_log_id', 'int')->autoIncrement();
			$table->addColumn('user_id', 'int');
			$table->addColumn('donation_date', 'int')->setDefault(0);
			$table->addColumn('donation_user_id', 'int');
			$table->addColumn('event_id', 'int');
			$table->addColumn('currency_id', 'int');
			$table->addColumn('amount', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('message', 'blob')->nullable(true);
			$table->addKey(['donation_date', 'user_id'], 'donation_date');
			$table->addKey('user_id');
			$table->addKey('donation_user_id');
		};
		
		$tables['xf_dbtech_credits_event'] = function (Create $table)
		{
			$table->addColumn('event_id', 'int')->autoIncrement();
			$table->addColumn('title', 'varchar', 255)->setDefault('');
			$table->addColumn('active', 'tinyint')->setDefault(1);
			$table->addColumn('currency_id', 'int');
			$table->addColumn('event_trigger_id', 'varchar', 255)->setDefault('');
			$table->addColumn('user_group_ids', 'blob')->nullable(true);
			$table->addColumn('node_ids', 'blob')->nullable(true);
			$table->addColumn('moderate', 'tinyint')->setDefault(0);
			$table->addColumn('charge', 'tinyint')->setDefault(0);
			$table->addColumn('main_add', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('main_sub', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('mult_add', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('mult_sub', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('delay', 'int')->setDefault(0);
			$table->addColumn('frequency', 'int')->setDefault('1');
			$table->addColumn('maxtime', 'int')->setDefault(0);
			$table->addColumn('applymax', 'int')->setDefault(0);
			$table->addColumn('upperrand', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('multmin', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('multmax', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('minaction', 'tinyint')->setDefault(0);
			$table->addColumn('owner', 'tinyint')->setDefault(0);
			$table->addColumn('curtarget', 'tinyint')->setDefault(0);
			$table->addColumn('alert', 'tinyint')->setDefault(0);
			$table->addColumn('display', 'tinyint', 3)->setDefault(1);
			$table->addColumn('settings', 'mediumblob')->nullable(true);
			$table->addKey(['active', 'display'], 'transaction_display');
		};
		
		$tables['xf_dbtech_credits_event_trigger'] = function (Create $table)
		{
			$table->addColumn('event_trigger_id', 'varchar', 100);
			$table->addColumn('title', 'varchar', 255)->setDefault('');
			$table->addColumn('description', 'blob')->nullable(true);
			$table->addColumn('active', 'tinyint')->setDefault(1);
			$table->addColumn('callback_class', 'varchar', 75)->setDefault('');
			$table->addColumn('multiplier', 'tinyint')->setDefault(0);
			$table->addColumn('multiplier_label', 'varchar', 255)->setDefault('');
			$table->addColumn('multiplier_popup', 'tinyint')->setDefault(0);
			$table->addColumn('parent', 'varchar', 255)->setDefault('');
			$table->addColumn('category', 'varchar', 255)->setDefault('');
			$table->addColumn('global', 'tinyint')->setDefault(1);
			$table->addColumn('revert', 'tinyint')->setDefault(0);
			$table->addColumn('cancel', 'tinyint')->setDefault(0);
			$table->addColumn('rebuild', 'tinyint')->setDefault(0);
			$table->addColumn('charge', 'tinyint')->setDefault(1);
			$table->addColumn('usergroups', 'tinyint')->setDefault(1);
			$table->addColumn('currency', 'tinyint')->setDefault(0);
			$table->addColumn('referformat', 'varchar', 255)->setDefault('');
			$table->addColumn('outbound', 'tinyint')->setDefault(1);
			$table->addColumn('inbound', 'tinyint')->setDefault(1);
			$table->addColumn('value', 'double')->unsigned(false)->setDefault(1);
			$table->addColumn('settings', 'mediumblob')->nullable(true);
			$table->addPrimaryKey('event_trigger_id');
		};
		
		$tables['xf_dbtech_credits_purchase_transaction'] = function (Create $table)
		{
			$table->addColumn('transaction_id', 'int')->autoIncrement();
			$table->addColumn('user_id', 'int')->setDefault(0);
			$table->addColumn('from_user_id', 'int')->setDefault(0);
			$table->addColumn('transaction_date', 'int', 10)->setDefault(0);
			$table->addColumn('amount', 'double', '10,2')->setDefault('0.00');
			$table->addColumn('cost', 'double', '10,2')->setDefault('0.00');
			$table->addColumn('event_id', 'int')->setDefault(0);
			$table->addColumn('currency_id', 'char', 3)->setDefault('');
			$table->addColumn('message', 'blob')->nullable(true);
			$table->addColumn('ip_id', 'int', 10)->setDefault(0);
			$table->addKey(['transaction_date', 'user_id'], 'transaction_date');
			$table->addKey('from_user_id');
			$table->addKey('user_id');
		};
		
		$tables['xf_dbtech_credits_redeem_log'] = function (Create $table)
		{
			$table->addColumn('redeem_log_id', 'int')->autoIncrement();
			$table->addColumn('user_id', 'int');
			$table->addColumn('redeem_date', 'int')->setDefault(0);
			$table->addColumn('redeem_code', 'varchar', 255);
			$table->addColumn('event_id', 'int');
			$table->addColumn('currency_id', 'int');
			$table->addColumn('amount', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('message', 'blob')->nullable(true);
			$table->addKey(['redeem_date', 'user_id'], 'redeem_date');
			$table->addKey('user_id');
		};
		
		$tables['xf_dbtech_credits_transaction'] = function (Create $table)
		{
			$table->addColumn('transaction_id', 'bigint')->autoIncrement();
			$table->addColumn('event_id', 'int')->setDefault(0);
			$table->addColumn('event_trigger_id', 'varchar', 255)->setDefault('');
			$table->addColumn('user_id', 'int')->setDefault(0);
			$table->addColumn('dateline', 'int')->setDefault(0);
			$table->addColumn('source_user_id', 'int')->setDefault(0);
			$table->addColumn('amount', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('status', 'tinyint')->setDefault(0);
			$table->addColumn('reference_id', 'varchar', 255)->nullable(true);
			$table->addColumn('content_type', 'varbinary', 25);
			$table->addColumn('content_id', 'int');
			$table->addColumn('node_id', 'int')->setDefault(0);
			$table->addColumn('owner_id', 'int')->setDefault(0);
			$table->addColumn('multiplier', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('currency_id', 'int')->setDefault(0);
			$table->addColumn('negate', 'tinyint')->setDefault(0);
			$table->addColumn('message', 'blob')->nullable(true);
			$table->addColumn('is_disputed', 'tinyint')->setDefault(0);
			$table->addColumn('balance', 'double')->unsigned(false)->setDefault(0);
			$table->addKey(['dateline', 'user_id', 'status'], 'dateline');
			$table->addKey(['dateline', 'transaction_id'], 'transaction_date');
			$table->addKey('user_id');
			$table->addKey(['user_id', 'event_id', 'status', 'negate', 'dateline'], 'user_id_stats');
		};
		
		$tables['xf_dbtech_credits_transfer_log'] = function (Create $table)
		{
			$table->addColumn('transfer_log_id', 'int')->autoIncrement();
			$table->addColumn('user_id', 'int');
			$table->addColumn('transfer_date', 'int')->setDefault(0);
			$table->addColumn('event_id', 'int');
			$table->addColumn('currency_id', 'int');
			$table->addColumn('amount', 'double')->unsigned(false)->setDefault(0);
			$table->addColumn('message', 'blob')->nullable(true);
			$table->addKey(['transfer_date', 'user_id'], 'transfer_date');
			$table->addKey('user_id');
		};
		
		return $tables;
	}
	
	/**
	 * @return array
	 */
	protected function getAdminPermissions()
	{
		return [];
	}
	
	/**
	 * @return array
	 */
	protected function getDefaultWidgetSetup()
	{
		return [
			'dbtech_credits_wallet' => function($key, array $options = [])
			{
				$options = array_replace([], $options);
				
				$this->createWidget(
					$key,
					'dbtech_credits_wallet',
					[
						'positions' => [
							'dbtech_credits_transactions_sidebar' => 10
						],
						'options' => $options
					]
				);
			},
			'dbtech_credits_richest' => function($key, array $options = [])
			{
				$options = array_replace([], $options);
				
				$this->createWidget(
					$key,
					'dbtech_credits_richest',
					[
						'positions' => [
							'dbtech_credits_transactions_sidebar' => 20
						],
						'options' => $options
					]
				);
			},
		];
	}
	
	/**
	 * @param $key
	 * @param array $options
	 *
	 * @throws \InvalidArgumentException
	 */
	protected function insertNamedWidget($key, array $options = [])
	{
		$widgets = $this->getDefaultWidgetSetup();
		if (!isset($widgets[$key]))
		{
			throw new \InvalidArgumentException("Unknown widget '$key'");
		}
		
		$widgetFn = $widgets[$key];
		$widgetFn($key, $options);
	}
	
	/**
	 * @param $oldGroupId
	 * @param $oldPermissionId
	 * @param $newGroupId
	 * @param $newPermissionId
	 *
	 * @throws \XF\Db\Exception
	 */
	protected function renamePermission($oldGroupId, $oldPermissionId, $newGroupId, $newPermissionId)
	{
		$this->executeUpgradeQuery('
			UPDATE xf_permission_entry
			SET permission_group_id = ?, permission_id = ?
			WHERE permission_group_id = ?
				AND permission_id = ?
        ', [$newGroupId, $newPermissionId, $oldGroupId, $oldPermissionId]);
		
		$this->executeUpgradeQuery('
			UPDATE xf_permission_entry_content
			SET permission_group_id = ?, permission_id = ?
			WHERE permission_group_id = ?
				AND permission_id = ?
        ', [$newGroupId, $newPermissionId, $oldGroupId, $oldPermissionId]);
		
		$this->executeUpgradeQuery('
			DELETE FROM xf_permission_entry
			WHERE permission_group_id = ?
				AND permission_id = ?
        ', [$oldGroupId, $oldPermissionId]);
		
		$this->executeUpgradeQuery('
			DELETE FROM xf_permission_entry_content
			WHERE permission_group_id = ?
				AND permission_id = ?
        ', [$oldGroupId, $oldPermissionId]);
	}
	
	/**
	 * @param null $previousVersion
	 *
	 * @return bool
	 */
	protected function applyDefaultPermissions($previousVersion = null)
	{
		$applied = false;
		
		if (!$previousVersion)
		{
			// Regular perms
			$this->applyGlobalPermission('dbtechCredits', 'view', 'general', 'viewNode');
			$this->applyGlobalPermissionInt('dbtechCredits', 'charge', 5);
			
			// Moderator perms
			$this->applyGlobalPermission('dbtechCredits', 'adjust', 'general', 'banUser');
			$this->applyGlobalPermission('dbtechCredits', 'viewAnyLog', 'general', 'bypassUserPrivacy');
			$this->applyGlobalPermission('dbtechCredits', 'bypassCurrencyPrivacy', 'general', 'bypassUserPrivacy');
			
			$applied = true;
		}
		
		if (!$previousVersion || $previousVersion < 905010031)
		{
			$this->applyGlobalPermission('dbtechCredits', 'bypassChargeTag', 'general', 'bypassUserPrivacy');
			
			$applied = true;
		}
		
		if (!$previousVersion || $previousVersion < 905010037)
		{
			$this->applyGlobalPermission('dbtechCredits', 'triggerEvents', 'general', 'viewNode');
			
			$applied = true;
		}
		
		if (!$previousVersion || $previousVersion < 905030031)
		{
			$this->applyGlobalPermission('dbtechCredits', 'viewModerated', 'forum', 'viewModerated');
			
			$applied = true;
		}
		
		return $applied;
	}
}