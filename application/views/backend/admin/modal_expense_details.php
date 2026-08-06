<?php
$from = $this->input->post('from');
$to   = $this->input->post('to');

$currency = $this->db->get_where('settings', array('type' => 'currency'))->row()->description;

$this->db->select('ec.expense_category_id, ec.name as expense_category, SUM(p.amount) as total');
$this->db->from('payment p');
$this->db->join('expense_category ec', 'ec.expense_category_id = p.expense_category_id', 'left');
$this->db->where('p.payment_type', 'expense');
if (!empty($from)) $this->db->where('p.timestamp >=', strtotime($from));
if (!empty($to))   $this->db->where('p.timestamp <=', strtotime($to) + 86399);
$this->db->group_by('ec.expense_category_id');
$this->db->order_by('total', 'DESC');
$expenses = $this->db->get()->result_array();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">&nbsp;Expense Details</div>
            <div class="panel-body table-responsive">
                <table class="table display nowrap table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th class="bg-danger text-white">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; foreach ($expenses as $row): $total += $row['total']; ?>
                        <tr>
                            <td><?php echo html_escape($row['expense_category'] ?? 'N/A'); ?></td>
                            <td>
                                <a target="_blank" href="<?php echo base_url() . 'admin/cashbook?expcat_id=' . $row['expense_category_id'] . '&amp;income_type=debit&amp;from=' . $from . '&amp;to=' . $to; ?>">
                                    <?php echo $currency . ' ' . number_format($row['total'], 0); ?>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th><?php echo $currency . ' ' . number_format($total, 0); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
