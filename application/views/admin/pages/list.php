<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6 text-left">
                <h3 class="panel-title"><?php echo lang('pages title page_list'); ?></h3>
            </div>
            <div class="col-md-6 text-right">
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover-warning">
        <thead>

            <?php // sortable headers ?>
            <tr>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=page&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('pages col page'); ?></a>
                    <?php if ($sort == 'page') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=username&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('pages col username'); ?></a>
                    <?php if ($sort == 'username') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=last_update&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('pages col last_update'); ?></a>
                    <?php if ($sort == 'last_update') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td class="pull-right">
                    <?php echo lang('admin col actions'); ?>
                </td>
            </tr>

            <?php // search filters ?>
            <tr>
                <?php echo form_open("{$this_url}?sort={$sort}&dir={$dir}&limit={$limit}&offset=0{$filter}", array('role'=>'form', 'id'=>"filters")); ?>
                    <th<?php echo ((isset($filters['page'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'page', 'id'=>'page', 'class'=>'form-control input-sm', 'placeholder'=>lang('pages input page'), 'value'=>set_value('page', ((isset($filters['page'])) ? $filters['page'] : '')))); ?>
                    </th>
                    <th<?php echo ((isset($filters['username'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'username', 'id'=>'username', 'class'=>'form-control input-sm', 'placeholder'=>lang('pages input username'), 'value'=>set_value('username', ((isset($filters['username'])) ? $filters['username'] : '')))); ?>
                    </th>
                    <th<?php echo ((isset($filters['last_update'])) ? ' class="has-success"' : ''); ?>>
                        <input type="date" name="last_update" class="form-control input-sm" id="last_update" <?php echo empty($filters['last_update']) ? '' : 'value="'.$filters['last_update'].'"'; ?>>
                    </th>
                    <th colspan="3">
                        <div class="text-right">
                            <a href="<?php echo $this_url; ?>" class="btn btn-danger tooltips" data-toggle="tooltip" title="<?php echo lang('admin tooltip filter_reset'); ?>"><span class="glyphicon glyphicon-refresh"></span> <?php echo lang('core button reset'); ?></a>
                            <button type="submit" name="submit" value="<?php echo lang('core button filter'); ?>" class="btn btn-success tooltips" data-toggle="tooltip" title="<?php echo lang('admin tooltip filter'); ?>"><span class="glyphicon glyphicon-filter"></span> <?php echo lang('core button filter'); ?></button>
                        </div>
                    </th>
                <?php echo form_close(); ?>
            </tr>

        </thead>
        <tbody>

            <?php // data rows ?>
            <?php if ($total) : ?>
                <?php foreach ($pages as $page) : ?>
                    <tr>
                        <td<?php echo (($sort == 'page') ? ' class="sorted"' : ''); ?>>
                            <?php echo $page['page']; ?>
                        </td>
                        <td<?php echo (($sort == 'username') ? ' class="sorted"' : ''); ?>>
                            <?php echo $page['username']; ?>
                        </td>
                        <td<?php echo (($sort == 'last_update') ? ' class="sorted"' : ''); ?>>
                            <?php echo $page['last_update']; ?>
                        </td>
                        <td>
                            <div class="text-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url( $page['page'] ); ?>" rel="modal" class="btn btn-default tooltips" data-toggle="tooltip" title="<?php echo lang('pages button preview'); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <a href="<?php echo $this_url; ?>/edit/<?php echo $page['page']; ?>" class="btn btn-warning tooltips" data-toggle="tooltip" title="<?php echo lang('admin button edit'); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">
                        <?php echo lang('core error no_results'); ?>
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>

    <?php // list tools ?>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-2 text-left">
                <label><?php echo sprintf(lang('admin label rows'), $total); ?></label>
            </div>
            <div class="col-md-2 text-left">
                <?php if ($total > 10) : ?>
                    <select id="limit" class="form-control">
                        <option value="10"<?php echo ($limit == 10 OR ($limit != 10 && $limit != 25 && $limit != 50 && $limit != 75 && $limit != 100)) ? ' selected' : ''; ?>>10 <?php echo lang('admin input items_per_page'); ?></option>
                        <option value="25"<?php echo ($limit == 25) ? ' selected' : ''; ?>>25 <?php echo lang('admin input items_per_page'); ?></option>
                        <option value="50"<?php echo ($limit == 50) ? ' selected' : ''; ?>>50 <?php echo lang('admin input items_per_page'); ?></option>
                        <option value="75"<?php echo ($limit == 75) ? ' selected' : ''; ?>>75 <?php echo lang('admin input items_per_page'); ?></option>
                        <option value="100"<?php echo ($limit == 100) ? ' selected' : ''; ?>>100 <?php echo lang('admin input items_per_page'); ?></option>
                    </select>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php echo $pagination; ?>
            </div>
            <div class="col-md-2 text-right">
                <?php if ($total) : ?>
                    <a href="<?php echo $this_url; ?>/export?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?><?php echo $filter; ?>" class="btn btn-success tooltips" data-toggle="tooltip" title="<?php echo lang('admin tooltip csv_export'); ?>"><span class="glyphicon glyphicon-export"></span> <?php echo lang('admin button csv_export'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php // preview modal ?>
<div class="modal fade" id="modal-preview" tabindex="-1" role="dialog" aria-labelledby="modal-label-preview" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('core button close'); ?></span></button>
                <h4 class="modal-title"><?php echo lang('pages button preview'); ?></h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>