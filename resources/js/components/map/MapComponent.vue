<template>
    <div class="container">
        <div class="japan_map">
            <img usemap="#japan" :src=mapFile> 
            <!-- マップ -->
            <map name="japan">
                <area v-for="(map,key) in maps" value="wsegte" :key="key" :coords="map.coords" @click.prevent.stop="show(map)" :href="detailUrl + key" :alt="key">
                <modal name="map-modal">
                    <div class="modal-header">
                        <h2>{{ mapName }}</h2>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div>
                                <img v-for="file in mapFiles" :key="file" :src="file">
                            </div>
                        </div>
                        <a :href="'/map/map_detail/' + mapId" hclass="button">詳細</a>  
                        <button @click="hide">閉じる</button>  
                    </div>
                </modal>
            </map>
        </div>
    </div>
</template>

<script>
    export default {
        props:['maps'],
        data() {
            return {
                mapFile: '/images/japan_map.png',
                detailUrl: '/map/map_detail/',
                mapName: '',
                mapFiles:[],
                mapId: '',
            };
        },
        methods: {
            show : function(map) {
                var file = '/images/test.png'
                this.mapId = map.map_id
                this.mapName = map.name
                this.mapFiles = [file,file]
                console.log(this.mapFiles);
                this.$modal.show('map-modal')
            },
            hide : function () {
                this.mapName = ''
                this.$modal.hide('map-modal')
            },
        },
        created() {
        },
        mounted() {
        }
    }
</script>
