<template>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li :class="['all', activeAll]" @click="getMessages('all')" >
                    <a>
                        <i class="fa fa-envelope"></i> <span>Inbox</span>
                        <span :class="['pull-right-container', 'none-' + activeAll]">
                            <small class="label pull-right bg-red">{{ total }}</small>
                        </span>
                    </a>
                </li>
                <li dusk="aside-starred" :class="['starred-efecto']" @click="getMessages('starred')" >
                    <a :class="['starred', activeStarred]">
                        <i class="fa fa-star"></i> <span>Starred</span>
                        <span class="pull-right-container">
                            <small :class="['label pull-right bg-red', activeStarred, 'none-' + activeStarred]">{{ total }}</small>
                        </span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
</template>
<script>
export default {
    data() {
        return {
            all: true,
            starred: false,
            total: 0
        }
    },
    computed: {
        activeAll(){
            return this.all == true ? 'activeAll' : '';
        },
        activeStarred(){
            return this.starred == true ? 'activeStarred' : '';
        }
    },
    methods: {
        /** take into account the name that is sent by parameter to list the messages */
        getMessages(category){
            EventBus.$emit('list-messages', category);
        }
    },
    mounted() {
        EventBus.$on('active-category', (category, total) => {
            switch (category){
                case 'all':
                    this.all = true;
                    this.starred = false;
                    this.total = total;
                    break;           
                case 'starred':
                    this.starred = true;
                    this.all = false;
                    this.total = total;
                    break;     
            }
        });
    },
}
</script>
<style>
    .none-{
        display: none;
    }
    .sidebar-menu  .all{
        background: white!important;
        border-radius: 0 20px 20px 0;
    }
      
    .skin-blue .sidebar-menu > li:hover > a{
        background: #fce8e6!important;
        border-radius: 0 20px 20px 0;
    }

    .sidebar-menu .all a{
        color: black!important;
    }

    .sidebar-menu .starred{
        background: white!important;
        color: black!important;
    }
    .skin-blue .sidebar-menu > li:hover > .starred{
        background: rgba(242, 245, 245, 0.8)!important;
    }

    .all.activeAll{
        background: #fce8e6!important;
    }

    .all.activeAll .bg-red{
        background: #dd4b39!important;
    }

    .bg-red{
        background: black!important;
    }

    .sidebar-menu .all.activeAll a{
         color: #d93025!important;
    }

    .sidebar-menu .starred.activeStarred{
        background: rgba(242, 245, 245, 0.8)!important;
        border-radius: 0 20px 20px 0;
    }

</style>