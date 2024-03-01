<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title-add">
  <div class="title"><h2><?=$page_title?></h2></div>
</div> <br/>
<div class="report">
<div class="add"><a href="/selling/pdfgenerate" class="btn"><i class="bi bi-download"></i> Download PDF</a></div>
<!-- <form action="post" action="/report" class="report-form">
    <div class="input-group">
            <div>
                <select name="year-month" id="range-year-month" onchange="toggleMonthSelect()" required>
                    <option value="">Choose Range</option>
                    <option value="yearly">Yearly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
        </div>
    <div class="input-group" id="month-group" style="display: none;">
            <div>
                <select name="month" required>
                    <option value="">Choose Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
        </div>
    <div class="input-group">
            <div>
            <input type="text" name="year" required autocomplete="off" placeholder="Contoh: 2023">
            </div>
        </div>
</form> -->
</div>
<table id="myTable">
  <thead>
    <th>#</th>
    <th>Factur</th>
    <th>Date & Time</th>
    <th>Grand Total</th>
    <th>Payed Money</th>
    <th>Change</th>
    <th>Cashier</th>
    <th>Action</th>
  </thead>
  <tbody>
  <?php
    if(isset($SellingList)) :
    $html = null;
    $no = null;
    foreach($SellingList as $row) : 
    $no++;
        $html .='<tr>'; 
        $html .='<td>'.$no.'</td>'; 
        $html .='<td>'.$row->factur.'</td>'; 
        $html .='<td>'.$row->datetime.'</td>'; 
        $html .='<td>'.number_format($row->grand_total, 2, ',', '.').'</td>'; 
        $html .='<td>'.number_format($row->payed_money, 2, ',', '.').'</td>'; 
        $html .='<td>'.number_format($row->change_money, 2, ',', '.').'</td>'; 
        $html .='<td class="cashier_id">'.$row->cashier.'</td>';
        $html .='<td class="action"><a href="/sellingdetails/select/'.$row->factur.'" class="mr-2 h5 btn-see">See Details</a></td>';  
        $html .='</tr>';
      endforeach;    
      endif;
      echo $html;
  ?>
  </tbody>
</table>
<?=$this->endSection();?>