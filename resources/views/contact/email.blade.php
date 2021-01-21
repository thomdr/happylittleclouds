<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		h1, h2, h3, h4, h5, h6,
		p, li, span, a, strong, em, input, textarea, b, i, th, dt, dd,
		td, caption, figcaption, label, button, select, option, tr {
			word-wrap: break-word;
			word-break: break-word;   
			color: #333;
		}
		h1, h2, h3, h4, h5, h6 {
			font-family: Raleway, Arial, Helvetica, sans-serif;
		}
		p, li, span, a, strong, em, input, textarea, b, i, th, dt, dd,
		td, caption, figcaption, label, button, select, option, tr  {
			font-family: Montserrat, Verdana, Geneva, Tahoma, sans-serif;
			font-size: 16px;
			line-height: 26px;
		}
	</style>
</head>
<body>
	<div>
		<p>Naam: {{ $name }}</p>
		<p>Email: {{ $email }}</p>
		<div>
			<p>Bericht:</p>
			<p>{{ $msg }}</p>
		</div>
		
	</div>
</body>
</html>
