<?php
$from = $this->input->post('from');
$to   = $this->input->post('to');

$date_cond = '';
if (!empty($from) && !empty($to)) {
    $date_cond = " AND s.ad_date >= '" . $this->db->escape_str($from) . "' AND s.ad_date <= '" . $this->db->escape_str($to) . "'";
}

$this->db->select('c.class_id, c.name as class_name, COUNT(s.student_id) as total');
$this->db->from('class c');
$this->db->join('student s', 's.class_id = c.class_id AND s.status != 3' . $date_cond, 'left');
$this->db->group_by('c.class_id');
$this->db->order_by('c.sort_order', 'asc');
$classes = $this->db->get()->result_array();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">&nbsp;Students Details</div>
            <div class="panel-body table-responsive">
                <table class="table display nowrap table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th class="bg-success text-white">Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; foreach ($classes as $row): $total += $row['total']; ?>
                        <tr>
                            <td><?php echo html_escape($row['class_name']); ?></td>
                            <td>
                                <a target="_blank" href="<?php echo base_url() . 'admin/student_information?class_id=' . $row['class_id'] . '&amp;from=' . $from . '&amp;to=' . $to; ?>">
                                    <?php echo $row['total']; ?>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th><?php echo $total; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
