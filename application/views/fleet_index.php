<style>
    .fleet-table td, .fleet-table th {
        padding-right: 20px;
        padding-top: 3px;
        text-align: left;
    }



    .fleet-table th {
        border-bottom: 1px solid black
    }

</style>

<div id="body">
<h3>Swallow Fleet</h3>
<!--    0 => array('code' => IDENTIFIER_CHAR . "001", 'depart_airport' => 0, 'depart_time' => '12:25', 'arrive_airport' => 1, 'arrive_time' => '23:15' )
-->

{add}
    <table class="fleet-table">
        <tr><th>Airplane Model</th></tr>
        {fl}
    </table>


    <!--{flights}
        {code} {depart_airport} -> {arrive_airport}
    {/flights}-->

</div>


