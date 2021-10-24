<template>
</template>
<script>
export default {
    name: "Verify",
    created() {
        const url = window.location.href;
        const token_id =  url.slice(url.indexOf("=")+1, url.length);
        axios.post('verify-account', {
            token: token_id
        });
       this.$router.push('/');
    },
};
</script>

