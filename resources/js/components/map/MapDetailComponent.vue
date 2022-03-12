<template>
    <div class="container">
        <h1 class="map_name">{{ mapInfo.name }}</h1>
        <input type="file" name="memory_files[]" id="memory_files" multiple>
            <input v-for ="(value,key) in mapInfo   " :key=key type="hidden" :name="'map_info[' + key  + ']'" :value="value" multiple="multiple">
        <input type="submit" value="登録">

        <div class="file_list">
            <div v-for="(mapFile, key) in mapFiles" :key=key class="file" >
                <img  
                    :src="imageDirectory + mapFile[4]" 
                    width="200" 
                    height="200" 
                    @click.prevent.stop="showComment(mapFile)"
                     v-tooltip="'ファイル名：' + mapFile[3]"
                >
                <div>{{ mapFile[3] }}</div>
            </div>
            <modal name="commnet-modal">
                <div class="modal-header">
                    <h2>{{ fileName }}</h2>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="text" v-model="commentValue">
                    </div>
                    <a class="button" @click="commentRegist">登録</a>  
                    <button type="button" @click="hideComment">閉じる</button>  
                </div>
            </modal>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            post:{
                type: Object,
                required: true,
            },
        },
        data() {
            return {
                imageDirectory: '/storage/',
                mapInfo: this.post.map_info,
                mapId: this.post.map_info.map_id,
                mapFiles: [],
                commentFile: [],
                fileName: '',
                fileSeq: '',
                commentList: [],
                commentValue: '',
            };
        },
        methods: {
            showComment : function(mapFile) {
                this.commentFile = mapFile
                this.fileName = mapFile[3]
                this.fileSeq = mapFile[0]
                this.commentList = ['コメント１','まじまんじ','うちら最強☆','おれら魔法使い（童貞）']
                this.$modal.show('commnet-modal')
            },
            hideComment : function () {
                this.commentFile = []
                this.commentValue = ''
                this.fileSeq = ''
                this.$modal.hide('commnet-modal')
            },
            getMapFiles() {
                var url = '/api/getMapFiles/' + this.mapId
                console.log(url)
                let $this = this
                axios.get(url)
                    .then(function(res){
                        //vueにバインドされている値を書き換えると表示に反映される
                        app.result = res.data
                        $this.mapFiles = res.data/*
                        var i = 0
                        for (i; i<res.data.length; i++) {
                            $this.mapFiles.push(Object.values(res.data[i]))
                        }*/
                    })
                    .catch(function(res){
                        //vueにバインドされている値を書き換えると表示に反映される
                        app.result = res.data
                        console.log(res)
                    })
                this.mapFiles.splice()
            },
            commentRegist: function () {
                let $this = this
                axios.post('/api/commentRegist',[this.mapId, this.fileSeq,this.commentValue])
                    .then(function(res){
                        //vueにバインドされている値を書き換えると表示に反映される
                        app.result = res.data
                        $this.getMapFiles()
                    })
                    .catch(function(res){
                        //vueにバインドされている値を書き換えると表示に反映される
                        app.result = res.data
                    })
                this.hideComment()
            }
        },
        created: function () {
            /*
            var i = 0
            for (i; i< this.post.files.length; i++) {
                $this.mapFiles.push(Object.values(this.post.files[i]))
            }
            */
            this.getMapFiles();
        },
        mounted() {
        }
    }
</script>
