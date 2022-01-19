<table cellspacing="0" cellpadding="0" border="1">
        <tbody>
            <tr>
                <td style="background: #4563E6; color:#ffffff">id</td>
                <td style="background: #4563E6; color:#ffffff">name</td>
                <td style="background: #4563E6; color:#ffffff">birth date</td>
                <td style="background: #4563E6; color:#ffffff">created_at</td>
            </tr>
            @if(count($users) > 0)
                @foreach ($users as $b => $user)
                <tr>
                    <td>{{$user["id"]}}</td>
                    <td>{{$user["name"]}}</td>
                    <td>{{$user["birth_date"]}}</td>
                    <td>{{$user["created_at"]}}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" align="center">No se encontraron registros</td>
                </tr>
            @endif
        </tbody>
</table>
