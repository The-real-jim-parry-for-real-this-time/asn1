<style>
    .dash-table td, .dash-table th {
        padding-right: 20px;
        padding-top: 3px;
        text-align: left;
    }



    .dash-table th {
        border-bottom: 1px solid black
    }

</style>

<div id="body">
<h3>Dashboard</h3>
    <table class="dash-table">
    {base}
        <tr>
            <td>Base</td>
            <td>{name} ({code})</td>
        </tr>
    {/base}
    {dest}
        <tr>
            <td>Destination {id}</td>
            <td>{name} ({code})</td>
        </tr>
    {/dest}
        <tr>
            <td>Number of Planes</td>
            <td>{count}</td>
        </tr>
    {flights}
        <tr>
            <td>Flight {id}</td>
            <td>{depart_airport}{name}{/depart_airport} to {arrive_airport}{name}{/arrive_airport} ({code})</td>
        </tr>
    {/flights}
    </table>

</div>


