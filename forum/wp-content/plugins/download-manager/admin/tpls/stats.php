<?php
$type = wpdm_query_var('type', array('validate' => 'txt', 'default' => 'overview'));
$base_page_uri = "edit.php?post_type=wpdmpro&page=wpdm-stats";
?>
<div class="wrap w3eden">

    <div class="panel panel-default" id="wpdm-wrapper-panel">
        <div class="panel-heading">
            <a class="btn btn-primary btn-sm pull-right" href="<?= $base_page_uri; ?>&task=export&__xnonce=<?=wp_create_nonce(NONCE_KEY); ?>" style="font-weight: 400">
                <i class="sinc far fa-arrow-alt-circle-down"></i> <?php _e("Export History", 'download-manager'); ?>
            </a>
            <b><i class="fas fa-chart-line color-purple"></i> &nbsp; <?php echo __("Download Statistics", "download-manager"); ?></b>

        </div>
        <!-- Tabs -->
        <ul id="tabs" class="nav nav-tabs nav-wrapper-tabs" style="padding: 60px 10px 0 10px;background: #f5f5f5">
            <!-- overview -->
            <li <?= ($type == 'overview' && !isset($_GET['task'])) ? 'class="active"' : ''; ?>>
                <a href='<?= $base_page_uri; ?>'> <?php echo __("Overview", "download-manager"); ?> </a>
            </li>
            <!-- history -->
            <li <?= ($type == 'history') ? 'class="active"' : ''; ?>>
                <a href='<?= $base_page_uri; ?>&type=history'><?php echo __("Download History", "download-manager"); ?></a>
            </li>

            <li <?= ($type == 'insight') ? 'class="active"' : ''; ?>>
                <a href='<?= $base_page_uri; ?>&type=insight'><?php echo __("Insights", "download-manager"); ?></a>
            </li>

            <?php
                $stat_types = [];
                $stat_types = apply_filters("wpdm_download_stat_type", $stat_types);
                foreach ($stat_types as $key => $stat_type){
                    ?>
                    <li <?= ($type == $key) ? 'class="active"' : ''; ?>>
                        <a href='<?= $base_page_uri; ?>&type=<?= $key ?>'><?php echo $stat_type['name']; ?></a>
                    </li>
                    <?php
                }
            ?>

            <!--<li <?php /*if(isset($_GET['type'])&&$_GET['type']=='pvdpu'){ */ ?>class="active"<?php /*} */ ?>><a href='edit.php?post_type=wpdmpro&page=wpdm-stats&type=pvdpu'><?php /*echo __( "Package vs Date" , "download-manager" ); */ ?></a></li>
            <li <?php /*if(isset($_GET['type'])&&$_GET['type']=='pvupd'){ */ ?>class="active"<?php /*} */ ?>><a href='edit.php?post_type=wpdmpro&page=wpdm-stats&type=pvupd'><?php /*echo __( "Package vs User" , "download-manager" ); */ ?></a></li>-->
        </ul>

        <div class="tab-content" style="padding: 15px;">
            <?php
            if(file_exists(WPDM_BASE_DIR . "admin/tpls/stats/{$type}.php")) include(WPDM_BASE_DIR . "admin/tpls/stats/{$type}.php");
            else if (isset($stat_types[$type])) call_user_func($stat_types[$type]['callback']);
            else WPDM_Messages::error(__( 'Stats not found!', 'download-manager' ));
            ?>
        </div>
    </div>

    <style>
        .notice{ display: none; }
    </style>