<template>
    <el-submenu index="2">
        <template slot="title">{{ game.day }}</template>
        <el-menu-item index="2-1"><a href="/advance">Advance Day</a></el-menu-item>
        <el-menu-item index="2-2"><a href="/freeagents">Next Week</a></el-menu-item>
        <el-menu-item index="2-3">Next Fight</el-menu-item>
    </el-submenu>
</template>
<script>
	export default {
		props: ['game']
	}
</script>