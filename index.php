<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title></title>
		<link rel="stylesheet" href="http://twitter.github.io/bootstrap/1.4.0/bootstrap.min.css" />
	</head>
	<body>
		<div class="container">
			<h1>User Manager</h1>
			<hr />
			<div class="page"></div>
		</div>
		
		<script type="text/template" id="user_id_template">
			<table class="table striped">
				<thead>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Age</th>
					<th></th>
				</thead>
				<tbody>
					<% _.each(users, function(user){%>
						<tr>
							<td><%=user.get('firstname')%></td>
							<td><%=user.get('lastname')%></td>
							<td><%=user.get('age')%></td>
							<td></td>
						</tr>
					<% });%>
				<tbody>
				
			</table>
		
		
		</script>
		
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.0.0/backbone-min.js"></script>
		
		<script>
			$.ajaxPrefilter( function( options, originalOptions, jqXHR ) {
				options.url = "http://backbonejs-beginner.herokuapp.com" + options.url;
			});
			
			var Users = Backbone.Collection.extend({
				url: "/users"
			});
			
			var UserList = Backbone.View.extend({
				el : '.page',
				render : function(){
					var that = this;
					var users = new Users();
					users.fetch({
						success: function(users){
							var template = _.template($('#user_id_template').html(), {users: users.models});
							console.log(users.models);
							that.$el.html(template);
						}
					});
				}
			});
			
			var Router = Backbone.Router.extend({
				routes : {
					'': 'home' //
				}
			});
			
			var userList = new UserList();
			var route = new Router();
			route.on('route:home', function(){
				userList.render();
				console.log("we have load homepage");
			});
			
			Backbone.history.start();
		</script>
	
	</body>
</html>
