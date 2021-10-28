<?php
// FROM HASH: 746104bb8cf557bb13040c1834368128
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.message-cell {
    a.button--spotifyModal {
        .button-text {
            margin-left: -3px;
            margin-right: -2px;
        }
        display: flex;
    }
}

a.button--spotifyModal {
    .button-text {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
    }
}

.spotifyPlayback {
    display: flex;
    //align-items: center;
    flex-grow: 1;

    &__albumArt {
        max-width: 100px;
        width: 100%;
    }

    &__trackDetails {
        margin-left: @xf-paddingLarge;
        flex-grow: 1;

        &__title {
            font-weight: bold;
            font-size: @xf-fontSizeLarge;
        }

        &__playBar {
            display: flex;
            border: 1px solid #000;
        }

        &__playButton {
            width: 21px;
            height: 21px;
            text-align: center;
            align-items: center;

            background: #1DB954;

            a, a:hover, a:visited {
                color: #FFF;
                display: block;
                width: 21px;
                height: 20px;
            }
        }

        &__progressBar {
            height: 21px;
            width: 100%;

            &__bar {
                background: #1DB954;
                height: 21px;
                transition: width 0.15s linear;
            }
        }
    }
}

.spotify__trackTitle {
    font-weight: bold;
    font-size: @xf-fontSizeLarge;
}

.spotify__albumThumbnail {
	width: 32px;
}';
	return $__finalCompiled;
});