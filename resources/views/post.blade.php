<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Download {{ $title }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
        <h4>{{ $title }}</h4>
        <img src="{{ $image }}">
        <h4>Plot</h4>
        <p>{{ $plot }}</p>
        <table>
            <tbody>
                <tr>
                    <td>
                        <span>
                            <strong>Source: </strong>
                        </span>
                    </td>
                    <td>
                        <span>
                            <strong>Smallencode & Kordramas</strong>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                @foreach($list as $key => $episode)
                <tr>
                    <!-- <td>{{ $key }}</td> -->
                    <td>
                        <center>Episode {{ $key }}</center>
                        <center>
                        360p: 
                        @if(is_string($episode[0]))
                        belum tersedia
                        @else
                            @foreach($episode[0] as $server)
                            <a href="{{ $server['link'] }}">{{ $server['server'] }}</a> {{ $loop->last ? '' : '|' }}
                            @endforeach
                        @endif
                        <br>
                        480p: 
                        @foreach($episode[1] as $server)
                        <a href="{{ $server['link'] }}">{{ $server['server'] }}</a> {{ $loop->last ? '' : '|' }}
                        @endforeach
                        <br>
                        540p: @foreach($episode[2] as $server)
                        <a href="{{ $server['link'] }}">{{ $server['server'] }}</a> {{ $loop->last ? '' : '|' }}
                        @endforeach
                        <br>
                        720p: @foreach($episode[3] as $server)
                        <a href="{{ $server['link'] }}">{{ $server['server'] }}</a> {{ $loop->last ? '' : '|' }}
                        @endforeach
                        </center>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
