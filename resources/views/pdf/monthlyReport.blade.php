<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monthly Report</title>
</head>
<body>
    <style>
        body{
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }
        img{
            height: 50px;
            width:  200px;
            text-align: center;

        }
    </style>
    <h4 style="font-size:20px; text-align:center">Monthly Report</h4>
    <div style="display: flex;">


        <div style="text-align: right"> Generated Date: {{ Carbon\Carbon::now()->format('M d Y') }} </div>
    </div>

   <table style="border: 2px solid black; width:100%; margin-bottom:30px;">
       <tr >
              <td style="padding-left:20px;">
                <h3>Name: {{ $user->name }}</h3>
                <p><span><b>Designation:</b></span>{{ $user->position }}</p>
                <p><span><b>Email:</b></span>{{ $user->email }}</p>
                <p><span><b>Phone:</b></span>{{ $user->number }}</p>
              </td>
              <td>
                <p style="font-size:16px; text-align:right;padding-right:20px;"><span><b>Month :</b></span>{{  $month }} <span><b>Year :</b></span>{{ $year }}</p>
              </td>
       </tr>
   </table>

   <table style="border:1px solid black;border-collapse: collapse;">
       <tr style="border:1px solid black; background:rgb(168, 218, 247); text-align:center">
           <td style="border:1px solid black; width:20%; padding:5px">
                <h4>Date</h4>
           </td>
           <td style="border:1px solid black; padding:5px">
                <h4>Daily Updates</h4>
           </td>
       </tr>
       @foreach($data as $data)
        <tr style="border:1px solid black;">
            <td style="border:1px solid black; width:15%; padding:5px; text-align:center">
                {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y')}}
            </td>
            <td style="border:1px solid black; padding:5px">
                    {!! $data->daily_update !!}
            </td>
        </tr>
       @endforeach
   </table>
</body>
</html>
