
<template>
<div>

</div>
</template>


<script type="text/javascript">
export default{
    created(){
        $('#LogoutModal').modal('toggle');
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        Toast.fire({
                icon: "success",
                title: "Logout successfully"
        });
        this.$router.push({
            name: "/"
        });
    }
}
</script>


<style type="text/css" scoped> 

</style>