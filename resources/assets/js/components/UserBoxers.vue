<template>
    <el-table
            :data="tableData"
            border
            :default-sort = "{prop: 'name', order: 'descending'}"
            style="width: 100%">
        <el-table-column
                prop="name"
                label="Name"
                sortable
                width="180">
        </el-table-column>
        <el-table-column
                prop="division"
                label="Division"
                sortable
                width="150">
        </el-table-column>
        <el-table-column
                prop="overall"
                label="Overall"
                sortable
                width="120">
        </el-table-column>
        <el-table-column
                prop="offense"
                label="Offense"
                sortable
                width="120">
        </el-table-column>
        <el-table-column
                prop="defense"
                label="Defense"
                sortable
                width="120">
        </el-table-column>
        <el-table-column
                prop="popularity"
                label="Popularity"
                sortable
                width="140">
        </el-table-column>
        <el-table-column
                prop="cost"
                label="Cost"
                sortable
                width="120">
        </el-table-column>
        <el-table-column
                inline-template
                label="Link"
                width="120">
                <span>
                    <el-button size="small" @click="viewBoxer(row.id)"> Link </el-button>
                </span>
        </el-table-column>
    </el-table>
</template>

<script>
    export default {
        data() {
            return {
                tableData: []
            }
        },

        created() {
            this.assign();
        },

        methods: {
            formatter(row, column) {
                return row.address;
            },

            assign() {
                axios.get('/api/boxers/user')
                    .then(this.refresh);
            },

            refresh({data}) {
                this.tableData = data;
            },

            viewBoxer(id) {
                window.location.href = '/boxers/' + id;
            }
        }
    }
</script>