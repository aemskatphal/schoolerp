<?php
$this->load->config('permission_config');
$modules = $this->config->item('permission_modules');
$action_labels = $this->config->item('action_labels');
$admin_id = $param2;
$admin_info = $this->db->where('admin_id', $admin_id)->get('admin')->row_array();

$existing_perms = array();
$perm_rows = $this->db->where('admin_id', $admin_id)->get('admin_permissions')->result_array();
foreach ($perm_rows as $r) {
    $existing_perms[$r['permission_key']] = true;
}
?>

<style>
.perm-tree { padding: 0; margin: 0; list-style: none; }
.perm-tree ul { padding-left: 20px; margin: 0; list-style: none; display: none; }
.perm-tree li { padding: 4px 0; }
.perm-tree > li { padding: 6px 0; border-bottom: 1px solid #eee; }
.perm-toggle { cursor: pointer; font-weight: 600; color: #333; padding: 4px 8px; display: inline-block; }
.perm-toggle:hover { color: #0073b7; }
.perm-toggle i { margin-right: 5px; width: 16px; text-align: center; }
.sub-mod-list { padding-left: 24px !important; display: none; }
.sub-mod-item { padding: 5px 0 5px 10px; border-left: 2px solid #e0e0e0; margin-left: 5px; }
.sub-mod-name { font-weight: 500; color: #555; }
.action-btns { display: inline-flex; flex-wrap: wrap; gap: 4px; margin-left: 10px; vertical-align: middle; }
.action-btns label { display: inline-block; font-size: 11px; padding: 2px 8px; border-radius: 3px; border: 1px solid #ccc; cursor: pointer; margin: 0; font-weight: 400; background: #f9f9f9; }
.action-btns label:hover { background: #e8f4fd; border-color: #0073b7; }
.action-btns input[type="checkbox"] { margin-right: 3px; vertical-align: middle; }
.action-btns label.active { background: #0073b7; color: #fff; border-color: #0073b7; }
.module-header { display: flex; align-items: center; gap: 8px; padding: 8px 10px; background: #f5f5f5; border-radius: 4px; margin-bottom: 2px; cursor: pointer; }
.module-header input[type="checkbox"] { margin: 0; }
.module-header .mod-label { font-weight: 700; font-size: 14px; color: #333; flex: 1; }
.module-header .mod-toggle-icon { color: #999; transition: transform 0.2s; }
.module-header .mod-toggle-icon.open { transform: rotate(90deg); }
.module-header:hover { background: #e8f4fd; }
.btn-select-all, .btn-deselect-all { font-size: 11px; padding: 2px 8px; margin-left: 5px; }
.perm-save-area { padding: 10px 0; border-top: 2px solid #eee; margin-top: 10px; text-align: right; }
#permSaveBtn { min-width: 120px; }
</style>

<div class="col-sm-12" style="max-width:100%">
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-shield"></i>&nbsp;&nbsp;Assign Role For: <strong><?php echo html_escape($admin_info['name']); ?></strong>
            <span class="pull-right" style="font-size:12px;color:#888;">
                Role: <?php echo ($admin_info['level'] == '1') ? 'Super Admin' : 'Normal User'; ?>
            </span>
        </div>
        <div class="panel-body" style="max-height:65vh; overflow-y:auto;">
            <div id="permTree">
                <?php foreach ($modules as $mod_key => $mod): ?>
                <div class="perm-module" data-mod="<?php echo $mod_key; ?>">
                    <div class="module-header" onclick="toggleModule('<?php echo $mod_key; ?>')">
                        <input type="checkbox" class="mod-cb" id="mod_<?php echo $mod_key; ?>"
                               data-mod="<?php echo $mod_key; ?>"
                               <?php if (!empty($existing_perms[$mod_key])) echo 'checked'; ?>
                               onchange="toggleModuleCb(this)">
                        <i class="fa fa-chevron-right mod-toggle-icon" id="mod_icon_<?php echo $mod_key; ?>"></i>
                        <span class="mod-label"><i class="<?php echo $mod['icon']; ?>" style="margin-right:5px;"></i><?php echo $mod['name']; ?></span>
                        <?php if (!empty($mod['submodules'])): ?>
                            <button type="button" class="btn btn-xs btn-default btn-select-all" onclick="event.stopPropagation(); selectAllSub('<?php echo $mod_key; ?>', true)">All</button>
                            <button type="button" class="btn btn-xs btn-default btn-deselect-all" onclick="event.stopPropagation(); selectAllSub('<?php echo $mod_key; ?>', false)">None</button>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($mod['submodules'])): ?>
                    <ul class="perm-tree sub-mod-list" id="subs_<?php echo $mod_key; ?>">
                        <?php foreach ($mod['submodules'] as $sub_key => $sub): ?>
                        <li class="sub-mod-item" data-sub="<?php echo $mod_key . '.' . $sub_key; ?>">
                            <div>
                                <input type="checkbox" class="sub-cb" id="sub_<?php echo $mod_key . '_' . $sub_key; ?>"
                                       data-mod="<?php echo $mod_key; ?>" data-sub="<?php echo $sub_key; ?>"
                                       <?php if (!empty($existing_perms[$mod_key . '.' . $sub_key])) echo 'checked'; ?>
                                       onchange="toggleSubCb(this)">
                                <span class="sub-mod-name"><?php echo $sub['name']; ?></span>
                                <?php if (!empty($sub['actions'])): ?>
                                <span class="action-btns" id="acts_<?php echo $mod_key . '_' . $sub_key; ?>">
                                    <?php foreach ($sub['actions'] as $act): ?>
                                    <label class="<?php if (!empty($existing_perms[$mod_key . '.' . $sub_key . '.' . $act])) echo 'active'; ?>">
                                        <input type="checkbox" class="act-cb"
                                               data-mod="<?php echo $mod_key; ?>" data-sub="<?php echo $sub_key; ?>" data-act="<?php echo $act; ?>"
                                               <?php if (!empty($existing_perms[$mod_key . '.' . $sub_key . '.' . $act])) echo 'checked'; ?>
                                               onchange="toggleActCb(this)">
                                        <?php echo isset($action_labels[$act]) ? $action_labels[$act] : ucfirst(str_replace('_', ' ', $act)); ?>
                                    </label>
                                    <?php endforeach; ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="perm-save-area">
                <span id="permSaveStatus" style="margin-right:10px;color:#5cb85c;font-weight:600;"></span>
                <button type="button" class="btn btn-info btn-sm" id="permSaveBtn" onclick="savePermissions()">
                    <i class="fa fa-save"></i>&nbsp; Save Permissions
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function toggleModule(mod) {
    var ul = document.getElementById('subs_' + mod);
    var icon = document.getElementById('mod_icon_' + mod);
    if (!ul) return;
    var isOpen = ul.style.display === 'block';
    ul.style.display = isOpen ? 'none' : 'block';
    if (icon) icon.classList.toggle('open', !isOpen);
}

function toggleModuleCb(cb) {
    var mod = cb.dataset.mod;
    var checked = cb.checked;
    cb.indeterminate = false;
    var subs = document.querySelectorAll('.sub-cb[data-mod="' + mod + '"]');
    subs.forEach(function(s) { s.checked = checked; });
    var acts = document.querySelectorAll('.act-cb[data-mod="' + mod + '"]');
    acts.forEach(function(a) { a.checked = checked; });
    var ul = document.getElementById('subs_' + mod);
    if (ul) ul.style.display = checked ? 'block' : 'none';
    var icon = document.getElementById('mod_icon_' + mod);
    if (icon) icon.classList.toggle('open', checked);
    updateActLabels(mod);
}

function toggleSubCb(cb) {
    var mod = cb.dataset.mod;
    var sub = cb.dataset.sub;
    var checked = cb.checked;
    var acts = document.querySelectorAll('.act-cb[data-mod="' + mod + '"][data-sub="' + sub + '"]');
    acts.forEach(function(a) { a.checked = checked; });
    updateActLabels(mod);
    updateModCb(mod);
}

function toggleActCb(cb) {
    var mod = cb.dataset.mod;
    var sub = cb.dataset.sub;
    var label = cb.parentElement;
    label.classList.toggle('active', cb.checked);
    updateSubCb(mod, sub);
    updateModCb(mod);
}

function updateActLabels(mod) {
    document.querySelectorAll('.act-cb[data-mod="' + mod + '"]').forEach(function(a) {
        a.parentElement.classList.toggle('active', a.checked);
    });
}

function updateSubCb(mod, sub) {
    var acts = document.querySelectorAll('.act-cb[data-mod="' + mod + '"][data-sub="' + sub + '"]');
    var anyChecked = false;
    acts.forEach(function(a) { if (a.checked) anyChecked = true; });
    var subCb = document.getElementById('sub_' + mod + '_' + sub);
    if (subCb && acts.length > 0) subCb.checked = anyChecked;
}

function updateModCb(mod) {
    var subs = document.querySelectorAll('.sub-cb[data-mod="' + mod + '"]');
    var modCb = document.getElementById('mod_' + mod);
    if (!modCb || subs.length === 0) return;
    var anyChecked = false, allChecked = true;
    subs.forEach(function(s) {
        if (s.checked) { anyChecked = true; } else { allChecked = false; }
    });
    modCb.checked = allChecked;
    modCb.indeterminate = anyChecked && !allChecked;
}

function selectAllSub(mod, check) {
    var modCb = document.getElementById('mod_' + mod);
    if (modCb) { modCb.checked = check; modCb.indeterminate = false; }
    document.querySelectorAll('.sub-cb[data-mod="' + mod + '"]').forEach(function(s) { s.checked = check; });
    document.querySelectorAll('.act-cb[data-mod="' + mod + '"]').forEach(function(a) { a.checked = check; });
    updateActLabels(mod);
    var ul = document.getElementById('subs_' + mod);
    if (ul) ul.style.display = check ? 'block' : 'none';
    var icon = document.getElementById('mod_icon_' + mod);
    if (icon) icon.classList.toggle('open', check);
}

function savePermissions() {
    var perms = [];
    document.querySelectorAll('.act-cb:checked').forEach(function(cb) {
        perms.push(cb.dataset.mod + '.' + cb.dataset.sub + '.' + cb.dataset.act);
    });
    document.querySelectorAll('.sub-cb:checked').forEach(function(cb) {
        perms.push(cb.dataset.mod + '.' + cb.dataset.sub);
    });
    document.querySelectorAll('.mod-cb').forEach(function(cb) {
        if (cb.checked || cb.indeterminate) perms.push(cb.dataset.mod);
    });
    var btn = document.getElementById('permSaveBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving...';
    $.ajax({
        url: '<?php echo base_url();?>admin/save_admin_permissions/<?php echo $admin_id; ?>',
        type: 'POST',
        data: { permissions: perms },
        success: function(resp) {
            document.getElementById('permSaveStatus').textContent = 'Saved!';
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-save"></i>&nbsp; Save Permissions';
            setTimeout(function() { document.getElementById('permSaveStatus').textContent = ''; }, 2500);
        },
        error: function() {
            document.getElementById('permSaveStatus').style.color = '#d9534f';
            document.getElementById('permSaveStatus').textContent = 'Error saving';
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-save"></i>&nbsp; Save Permissions';
        }
    });
}

(function initPermTree() {
    document.querySelectorAll('.mod-cb').forEach(function(cb) {
        var mod = cb.dataset.mod;
        var anySub = document.querySelectorAll('.sub-cb[data-mod="' + mod + '"]').length > 0;
        if (!anySub) return;
        var anyChecked = document.querySelectorAll('.sub-cb[data-mod="' + mod + '"]:checked').length > 0;
        var allChecked = document.querySelectorAll('.sub-cb[data-mod="' + mod + '"]:not(:checked)').length === 0;
        if (anyChecked && !allChecked) cb.indeterminate = true;
    });
})();
</script>
