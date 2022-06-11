<div class="container">
<f>
<input type="text" placeholder="請輸入url...">
<button type="submit" name="url">Submit</button>
<table border="1">
	<tr>
		<td width=5%>ScreenShot</td>
		<td width=5%>title</td>
		<td width=10%>description</td>
		<td width=5%>createdAt</td>
	</tr>	
@foreach($data as $item)
	<tr>
		<td width=5%>{{ $item->screenshot }}</td>
		<td width=5%>
			<a href="{{$item->link}}">{{$item->title}}</a>
		</td>
		<td width=10%>{{ $item->description }}</td>
		<td width=5%>{{ $item->created_at }}</td>
	</tr>
@endforeach
</table>
</div>

{{ $data->links() }}