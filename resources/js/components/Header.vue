<template>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<router-link class="navbar-brand" :to="{name: 'home'}">My SPA</router-link>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<router-link class="nav-item" tag="li" active-class="active" :to="{name: 'home'}" exact><a class="nav-link">Home</a></router-link>
					<router-link class="nav-item" tag="li" active-class="active" :to="{name: 'category'}"><a class="nav-link">Category</a></router-link>
				</ul>
			</div>
		</div>
	</nav>
</template>

<script>
export default {

}
</script>

<style>

</style>