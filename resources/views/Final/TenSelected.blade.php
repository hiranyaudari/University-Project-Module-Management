<html>
<body>

<ul> <span style="color: #f00000"> {{ $message }} </span> </ul>

<form action="" method="post">
  <table border="1" style="width:100%">

   <tr>
           <th></th>
           <th>Project Title</th>
           <th>Description</th>
           <th>Student Registration No</th>
           <th>Student Name</th>
           <th>Contact No</th>
           <th>Email Address</th>

   </tr>
     @foreach($pro as $prj)
           <tr>

           <td> {{ $prj->title }}</td>
           <td> {{ $prj->description }}</td>
           <td>{{$prj->regId}}</td>
           <td>{{$prj->name}}</td>
           <td>{{$prj->phone}}</td>
           <td>{{$prj->email}}</td>

           </tr>
     @endforeach
</table>



</form>

</body>
</html>