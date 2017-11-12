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
{airplane}
<h3>{model}</h3>
{/airplane}
<!--    0 => array('code' => IDENTIFIER_CHAR . "001", 'depart_airport' => 0, 'depart_time' => '12:25', 'arrive_airport' => 1, 'arrive_time' => '23:15' )
-->

    <table class="fleet-table">
        <tr><th>Manufacturer</th><th>Model</th><th>Price</th><th>Seats</th><th>Reach</th>
            <th>Cruise</th><th>Takeoff</th><th>Hourly</th></tr>
        <tr>
          {airplane}
            <td>{manufacturer}</td>
            <td>{model}</td>
            <td>{price}</td>
            <td>{seats}</td>
            <td>{reach}</td>
            <td>{cruise}</td>
            <td>{takeoff}</td>
            <td>{hourly}</td></tr>
          {/airplane}
    </table>


    <!--{flights}
        {code} {depart_airport} -> {arrive_airport}
    {/flights}-->

</div>


