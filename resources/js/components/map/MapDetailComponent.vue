<template>
    <div class="container">
        <h1 class="map_name">{{ mapInfo.name }}</h1>
        <input type="file" name="memory_photo[]" id="memory_photo" multiple>
            <input v-for ="(value,key) in mapInfo   " :key=key type="hidden" :name="'map_info[' + key  + ']'" :value="value" multiple="multiple">
        <input type="submit" value="登録">

        <div class="file_list">
            <div v-for="(mapPhoto, key) in mapPhotos" :key=key class="file" >
                <img  
                    :src="imageDirectory + mapPhoto.photo_hash_name" 
                    width="200" 
                    height="200" 
                    @click.prevent.stop="showComment(mapPhoto)"
                     v-tooltip="'ファイル名：' + mapPhoto.photo_name"
                >
                <div>{{ mapPhoto.photo_name }}</div>
            </div>
            <modal name="commnet-modal">
                <div class="modal-header">
                    <h2>{{ photoName }}</h2>
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
                areaId: this.post.map_info.area_id,
                mapPhotos: [],
                commentFile: [],
                photoName: '',
                photoId: '',
                commentList: [],
                commentValue: '',
            };
        },
        methods: {
            showComment : function(mapPhoto) {
                this.commentFile = mapPhoto
                this.photoName = mapPhoto.photo_name
                this.photoId = mapPhoto.photo_id
                this.commentList = ['コメント１','まじまんじ','うちら最強☆','おれら魔法使い（童貞）']
                this.$modal.show('commnet-modal')
            },
            hideComment : function () {
                this.commentFile = []
                this.commentValue = ''
                this.photoId = ''
                this.$modal.hide('commnet-modal')
            },
            getMapPhoto() {
                var url = '/api/getMapPhoto/' + this.areaId
                console.log(url)
                let $this = this
                axios.get(url)
                    .then(function(res){
                        //vueにバインドされている値を書き換えると表示に反映される
                        app.result = res.data
                        $this.mapPhotos = res.data/*
                        var i = 0
                        for (i; i<res.data.length; i++) {
                            $this.mapPhotos.push(Object.values(res.data[i]))
                        }*/
                    })
                    .catch(function(res){
                        //vueにバインドされている値を書き換えると表示に反映される
                        app.result = res.data
                        console.log(res)
                    })
                this.mapPhotos.splice()
            },
            commentRegist: function () {
                let $this = this
                axios.post('/api/commentRegist',[this.areaId, this.photoId,this.commentValue])
                    .then(function(res){
                        //vueにバインドされている値を書き換えると表示に反映される
                        app.result = res.data
                        $this.getMapPhoto()
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
                $this.mapPhotos.push(Object.values(this.post.files[i]))
            }
            */
            this.getMapPhoto();
        },
        mounted() {
        }
    }
</script>
