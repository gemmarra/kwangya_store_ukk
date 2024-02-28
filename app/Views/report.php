<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title"><h2><?=$page_title?></h2></div>
<br>
<h5>Fill this form below to see reports</h5>
<form method="post" action="/reportgenerate">
    <form-1 style="margin-bottom:10px;">
    <div class="input-group">
            <label for="year-month">Range</label>
            <div>
                <select name="year-month" id="range-year-month" onchange="toggleMonthSelect()" required>
                    <option value="">Choose Range</option>
                    <option value="Yearly">Yearly</option>
                    <option value="Monthly">Monthly</option>
                </select>
            </div>
        </div>
    <div class="input-group" id="month-group" style="display: none;">
            <label for="month">Month</label>
            <div>
                <select name="month">
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
            <label for="year">Year</label>
            <div>
            <input type="text" name="year" required autocomplete="off" placeholder="Contoh: 2023">
            </div>
        </div>
        <button type="submit" class="btn"><i class="bi bi-search"></i> Search</button>
    </form-1>
</form>

<?=$this->endSection();?>