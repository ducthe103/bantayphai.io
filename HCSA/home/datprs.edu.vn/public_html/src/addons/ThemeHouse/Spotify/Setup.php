<?php

namespace ThemeHouse\Spotify;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Create;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	public function installStep1()
    {
        $this->db()->insert('xf_connected_account_provider', [
            'provider_id' => 'thspotify',
            'provider_class' => 'ThemeHouse\Spotify:Provider\Spotify',
            'display_order' => 90,
            'options' => json_encode([
                'client_id' => '',
                'client_secret' => '',
            ]),
        ]);
    }

    public function installStep2()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->createTable('xf_thspotify_song', function(Create $table) {
            $table->addColumn('song_id', 'varchar', 50)->primaryKey();
            $table->addColumn('song_name', 'varchar', 250);
            $table->addColumn('duration_ms', 'int');
            $table->addColumn('explicit', 'boolean');
            $table->addColumn('album_name', 'varchar', 250);
            $table->addColumn('album_thumbnail', 'varchar', 250);
            $table->addColumn('artists', 'text');
            $table->addColumn('spotify_url', 'varchar', 100);
            $table->addColumn('spotify_uri', 'varchar', 100);
            $table->addColumn('spotify_album_url', 'varchar', 100);
            $table->addColumn('spotify_album_uri', 'varchar', 100);
            $table->addColumn('last_play', 'int');
            $table->addColumn('last_play_user_id', 'int');
            $table->addColumn('plays', 'int')->setDefault(1);
            $table->addKey('plays');
        });
    }

    public function installStep3()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->createTable('xf_thspotify_user_playback', function(Create $table) {
            $table->addColumn('user_id', 'int')->primaryKey();
            $table->addColumn('song_id', 'varchar', 50)->nullable();
            $table->addColumn('progress_ms', 'int');
            $table->addColumn('last_update', 'int');
            $table->addKey(['song_id', 'last_update']);
        });
    }

    public function installStep4()
    {
        $this->schemaManager()->alterTable('xf_user_privacy', function(Alter $table) {
            $table->addColumn('th_spotify_allow_view_playing', 'enum', ['everyone', 'members', 'followed', 'none'])->setDefault('everyone');
        });
    }

    public function upgrade1000091Step1()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->alterTable('xf_thspotify_song', function (Alter $table) {
            $table->addKey('plays');
        });
    }

    public function upgrade1000091Step2()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->alterTable('xf_thspotify_user_playback', function (Alter $table) {
            $table->addKey(['song_id', 'last_update']);
        });
    }

    public function upgrade1000111Step1()
    {
        $this->schemaManager()->alterTable('xf_user_privacy', function(Alter $table) {
            $table->addColumn('th_spotify_allow_view_playing', 'enum', ['everyone', 'members', 'followed', 'none'])->setDefault('everyone');
        });
    }

    public function uninstallStep1()
    {
        $connectedAccountProvider = $this->app->em()->find('XF:ConnectedAccountProvider', 'thspotify');
        $connectedAccountProvider->delete();
    }

    public function uninstallStep2()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->dropTable('xf_thspotify_song');
    }

    public function uninstallStep3()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->dropTable('xf_thspotify_user_playback');
    }

    public function uninstallStep4()
    {
        $this->schemaManager()->alterTable('xf_user_privacy', function(Alter $table) {
            $table->dropColumns(['th_spotify_allow_view_playing']);
        });
    }
}