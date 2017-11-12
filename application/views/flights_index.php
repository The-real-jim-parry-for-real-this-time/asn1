
<style>
    .flights-table td, .flights-table th {
        padding-right: 20px;
        padding-top: 3px;
        text-align: left;
    }



    .flights-table th {
        border-bottom: 1px solid black
    }

</style>

<div id="body">
<h3>Current Swallow Flights</h3>

    {add}
    <table class="flights-table">
        <tr><th>Flight Code</th><th>Airplane</th><th>Departure</th><th>Arrival</th></tr>
    {f}
    </table>


    <!--{flights}
        {code} {depart_airport} -> {arrive_airport}
    {/flights}-->

</div>


