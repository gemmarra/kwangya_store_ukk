<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title"><h2><?=$page_title?></h2></div>
<br>
<h5>Fill this form below to see reports</h5>
<form action="post" action="/report">
    <form-1>
    <div class="input-group">
            <label for="year-month">Range</label>
            <div>
                <select name="year-month" id="range-year-month" onchange="toggleMonthSelect()" required>
                    <option value="">Choose Range</option>
                    <option value="yearly">Yearly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
        </div>
    <div class="input-group" id="month-group" style="display: none;">
            <label for="month">Month</label>
            <div>
                <select name="month" required>
                    <option value="">Choose Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
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
    </form-1>
</form>

<?=$this->endSection();?>