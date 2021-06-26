@if(session()->has('success'))
<script type="text/javascript">
	$(function(){
		alertify.alert(" {!! session()->get('success') !!} ").set({title:"Success"});
		alertify.success("{!! session()->get('success') !!}");
	});
</script>
@elseif(session()->has('error'))
<script type="text/javascript">
	$(function(){
		alertify.alert(" {!! session()->get('error') !!} ").set({title:"Error"});
		alertify.success("{!! session()->get('error') !!}");
	});
</script>
@endif