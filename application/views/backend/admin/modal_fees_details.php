<?php
$type = $this->input->post('type');
$year = $this->input->post('year');
$from = $this->input->post('from');
$to   = $this->input->post('to');

$currency = $this->db->get_where('settings', array('type' => 'currency'))->row()->description;

$classes = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();

$title = 'Fees Details';
$head_bg = '#03a9f3';
if ($type == 'totalfees') {
    $head_bg = '#26dad6';
    $title = 'Total Fees';
} elseif ($type == 'paidfees') {
    $head_bg = '#03a9f3';
    $title = 'Paid Fees';
} elseif ($type == 'duefees') {
    $head_bg = '#ef5350';
    $title = 'Due Fees';
} elseif ($type == 'discountfees') {
    $head_bg = '#7460ee';
    $title = 'Discount Fees';
} elseif ($type == 'todayfees') {
    $head_bg = '#1e88e5';
    $title = 'Fees Details';
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading" style="background: <?php echo $head_bg; ?>;">&nbsp;<?php echo $title; ?></div>
            <div class="panel-body table-responsive">
                <table class="table display nowrap table-bordered fee-data" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <?php if ($type == 'todayfees'): ?>
                                <th>Class</th>
                                <th>Total Collection</th>
                                <th>Online</th>
                                <th>Cash</th>
                            <?php else: ?>
                                <th>Class</th>
                                <th><?php echo ($type == 'discountfees') ? 'Discount' : 'Total'; ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($type == 'todayfees') {
                            $class_ids = array();
                            foreach ($classes as $cls) {
                                $class_ids[] = $cls['class_id'];
                            }
                            $class_id_str = implode(',', array_map('intval', $class_ids));
                            $sql = "SELECT s.class_id,
                                           IFNULL(SUM(p.amount), 0) AS total_collection,
                                           IFNULL(SUM(CASE WHEN p.method='1' THEN p.amount ELSE 0 END), 0) AS online_amount,
                                           IFNULL(SUM(CASE WHEN p.method='2' THEN p.amount ELSE 0 END), 0) AS cash_amount
                                    FROM payment p
                                    LEFT JOIN student s ON s.student_id = p.student_id
                                    WHERE p.payment_type='income'
                                      AND s.class_id IN (" . $class_id_str . ")";
                            if (!empty($from)) $sql .= " AND p.timestamp >= " . intval(strtotime($from));
                            if (!empty($to))   $sql .= " AND p.timestamp <= " . intval(strtotime($to) + 86399);
                            if (!empty($year)) $sql .= " AND p.year = " . $this->db->escape($year);
                            $sql .= " GROUP BY s.class_id";
                            $rows = $this->db->query($sql)->result_array();
                            $collection_map = array();
                            foreach ($rows as $row) {
                                $collection_map[$row['class_id']] = $row;
                            }
                        }
                        $grand_total = 0;
                        $grand_online = 0;
                        $grand_cash = 0;
                        foreach ($classes as $cls):
                            $total = 0;
                            if ($type == 'todayfees') {
                                $row = isset($collection_map[$cls['class_id']]) ? $collection_map[$cls['class_id']] : null;
                                $total = $row ? floatval($row['total_collection']) : 0;
                                $online = $row ? floatval($row['online_amount']) : 0;
                                $cash = $row ? floatval($row['cash_amount']) : 0;
                                $grand_total += $total;
                                $grand_online += $online;
                                $grand_cash += $cash;
                            } else {
                                $this->db->where('status !=', '3');
                                $this->db->where('class_id', $cls['class_id']);
                                if (!empty($year)) $this->db->where('year', $year);
                                if ($type == 'paidfees') {
                                    $this->db->where('amount_paid >', 0);
                                } elseif ($type == 'duefees') {
                                    $this->db->group_start();
                                    $this->db->where('amount > (amount_paid + discount)');
                                    $this->db->or_where('amount_paid', 0);
                                    $this->db->group_end();
                                } elseif ($type == 'discountfees') {
                                    $this->db->where('discount >', 0);
                                }
                                if ($type == 'paidfees') {
                                    $this->db->select_sum('amount_paid');
                                    $row = $this->db->get('invoice')->row();
                                    $total = floatval($row->amount_paid ?? 0);
                                } elseif ($type == 'duefees') {
                                    $this->db->select('SUM(amount - amount_paid - discount) as due_amount');
                                    $row = $this->db->get('invoice')->row();
                                    $total = floatval($row->due_amount ?? 0);
                                } elseif ($type == 'discountfees') {
                                    $this->db->select_sum('discount');
                                    $row = $this->db->get('invoice')->row();
                                    $total = floatval($row->discount ?? 0);
                                } else {
                                    $this->db->select_sum('amount');
                                    $row = $this->db->get('invoice')->row();
                                    $total = floatval($row->amount ?? 0);
                                }
                                $grand_total += $total;
                            }
                        ?>
                        <tr>
                            <td><?php echo html_escape($cls['name']); ?></td>
                            <?php if ($type == 'todayfees'): ?>
                                <td>
                                    <a href="<?php echo base_url(); ?>admin/manage_receipt?class_id=<?php echo $cls['class_id']; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?>&year=<?php echo $year; ?>" target="_blank">
                                        <strong><?php echo number_format($total, 0); ?></strong>
                                    </a>
                                </td>
                                <td><?php echo ($online > 0) ? number_format($online, 0) : '-'; ?></td>
                                <td><?php echo ($cash > 0) ? number_format($cash, 0) : '-'; ?></td>
                            <?php else: ?>
                                <td>
                                    <a href="<?php echo base_url(); ?>admin/student_invoice_dashboard/<?php echo $cls['class_id']; ?>/<?php echo $year; ?>/<?php
                                    if ($type == 'paidfees') echo 'paid';
                                    elseif ($type == 'duefees') echo 'due';
                                    elseif ($type == 'discountfees') echo 'yes';
                                    else echo 'all';
                                ?>" target="_blank">
                                        <strong><?php echo $currency . ' ' . number_format($total, 0); ?></strong>
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <?php if ($type == 'todayfees'): ?>
                                <th><b>Total</b></th>
                                <th><strong><?php echo number_format($grand_total, 0); ?></strong></th>
                                <th><?php echo ($grand_online > 0) ? number_format($grand_online, 0) : '-'; ?></th>
                                <th><?php echo ($grand_cash > 0) ? number_format($grand_cash, 0) : '-'; ?></th>
                            <?php else: ?>
                                <th><b>Total</b></th>
                                <th><strong><?php echo $currency . ' ' . number_format($grand_total, 0); ?></strong></th>
                            <?php endif; ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
