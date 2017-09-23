<template>
    <el-menu theme="dark" :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
        <el-menu-item index="1"><a href="/home">Home</a></el-menu-item>

        <advance-day :game="game"></advance-day>
        
        <el-submenu index="3">
            <template slot="title">Boxers</template>
            <el-menu-item index="3-1"><a href="/boxers">Your Boxers</a></el-menu-item>
            <el-menu-item index="3-2"><a href="/freeagents">Free Agents</a></el-menu-item>
        </el-submenu>

        <el-submenu index="4">
            <template slot="title">Promotion</template>
            <el-menu-item index="4-1"><a href="/history">Fight History</a></el-menu-item>
        </el-submenu>

        <el-menu-item index="5"><a href="/create">Create Card</a></el-menu-item>
        <el-menu-item index="6"><a href="/rankings">Rankings</a></el-menu-item>

        <el-menu-item index="7">{{ game.funds }}</el-menu-item>
    </el-menu>
</template>

<script>
    export default {
        props: ['game'],

        data() {
            return {
                activeIndex: '1',
                activeIndex2: '1'
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            }
        }
    }
</script>