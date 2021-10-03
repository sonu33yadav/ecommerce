//import Vue from 'vue';
window.Vue = require('vue');
window.axios = require('axios');
module.exports = {
    runtimeCompiler: true
}

const baseUrl = '/'

const app = new Vue({
    el: '#vue_app',
    data: {
        use_recommend: 0,
        new_question: null,
        new_answer: null,
        questionList: [],
        maxId: 0,
        cu_question: 0,

        answerList: [],
        answerSeries: [],
        answerSeriesIndex: 0,
        answerCounts: [],
        selAnswers: [],

        recommend_product: []
    },
    methods: {
        getSetting() {
            axios.post(baseUrl + 'admin/getSetting', {_token:_token}).then((resp) => {
                this.use_recommend = resp.data.setting?resp.data.setting.use_recommendation:0;
            }).catch((error) => {
                console.log("get setting error")
            })
        },
        changeSetting(){
            let val = this.use_recommend?1:0;
            axios.post(baseUrl + 'admin/changeSetting', {_token:_token, use_recommend: val}).then((resp) => {
                if(resp.data.result)
                    $.growl.notice({
                        title: "Success",
                        message: "Setting was changed.",
                        duration: 3000
                    });
            }).catch((error) => {
                $.growl.warning({
                    title: "Error",
                    message: "Cannot change the setting",
                    duration: 3000
                });
            })
        },
        addQuestion(){
            if(this.new_question == null)
                return;
            this.questionList.push({id: this.maxId, value:this.new_question})
            this.cu_question = this.maxId;
            this.maxId++;
            this.new_question = null;
            $('#addModal').modal('hide')
            console.log(this.questionList)
        },
        deleteQuestion(id){
            let remove_index = 0;
            for (let i=0; i<this.questionList.length; i++){
                let item = this.questionList[i];
                if(item.id == id)
                {
                    break;
                }
                remove_index++;
            }
            this.questionList.splice(remove_index, 1)
            this.answerList[id] = [];
            console.log(this.answerList);
            if(this.questionList.length > 0)
                this.cu_question = this.questionList[0].id;
            else
                this.cu_question = 0;

            this.getAnswerSeries();
        },
        changeQuestion(action){
            let ind = 0;
            for (let i=0; i<this.questionList.length; i++){
                if(this.questionList[i].id == this.cu_question){
                    break;
                }
                ind++;
            }
            if(action == "prev"){
                if(ind > 0){
                    this.cu_question = this.questionList[ind-1].id;
                }
            }else if (action == 'next'){
                if(ind < this.questionList.length - 1){
                    this.cu_question = this.questionList[ind+1].id;
                }
            }
            // if(action == "prev" && this.cu_question > 0)
            //     this.cu_question--;
            // else if(action == "prev" && this.cu_question == 0)
            //     this.cu_question = this.questionList.length-1;
            // else if(action == 'next' && this.cu_question < this.questionList.length-1)
            //     this.cu_question++;
            // else if(action == 'next' && this.cu_question == this.questionList.length-1)
            //     this.cu_question = 0;
        },
        showAnswerModal(){
            $('#addAnswerModal').modal('show')
        },
        addAnswer(){
            let answers = this.answerList[this.cu_question];
            let max_answer_id = 0;
            if(answers.length == 0){
                max_answer_id = 0;
            }else{
                for(let i=0; i<answers.length; i++){
                    if(answers[i].id > max_answer_id)
                        max_answer_id = answers[i].id;
                }
                max_answer_id++;
            }

            this.answerList[this.cu_question].push({id:max_answer_id, value:this.new_answer});
            this.new_answer = null;
            $('#addAnswerModal').modal('hide')
            this.recommend_product = [];
            this.getAnswerSeries()
        },
        getAnswerSeries(){
            this.answerSeries = [];
            this.answerSeriesIndex = 0;
            this.answerCounts = [];
            for(let i=0; i<this.questionList.length; i++){
                if (this.answerList[this.questionList[i].id].length>0){
                    this.answerCounts.push(this.answerList[this.questionList[i].id].length);
                }
            }
            this.selAnswers = [];
            console.log("answercount")
            console.log(this.answerCounts);
            this.makeAnswerSeries(0, this.questionList.length)
            setTimeout(function(){
                $('.select2').select2({
                    minimumResultsForSearch: Infinity
                });
            }, 500);
        },
        makeAnswerSeries(id, deep){
            if(id == deep) {
                this.answerSeries.push({id:this.answerSeriesIndex, value:this.selAnswers.join("-")});
                this.answerSeriesIndex++;
                return ;
            }
            for(let i = 0; i < this.answerCounts[id]; i++){
                this.selAnswers[id] = this.answerList[this.questionList[id].id][i].id + 1;
                this.makeAnswerSeries(id + 1, deep);
            }
        },
        save(){
            if(this.questionList.length == 0){
                $.growl.warning({
                    title: "Error",
                    message: "Please add questions.",
                    duration: 3000
                });
                return;
            }
            for(let i=0; i<this.answerSeries.length; i++){
                this.recommend_product[i] = $('#product_' + i).val()
            }

            axios.post(baseUrl + 'admin/product/recommend/save', {_token:_token, questions: this.questionList, answers: this.answerList, answer_series: this.answerSeries, products: this.recommend_product}).then((resp) => {
                if(resp.data.status && resp.data.result){
                    $.growl.notice({
                        title: "Success",
                        message: "Recommendation was saved",
                        duration: 3000
                    });
                }
            }).catch((error) => {
                $.growl.warning({
                    title: "Error",
                    message: "Please try again.",
                    duration: 3000
                });
            })
        },
        getPreviousData(){
            axios.post(baseUrl + 'admin/product/recommend/get', {_token:_token}).then((resp) => {
                if(resp.data.status){
                    let ref = this;
                    let questions = resp.data.questions;
                    let answers = resp.data.answers;
                    let pairs = resp.data.pairs;
                    for(let i=0; i<questions.length; i++){
                        this.questionList.push({id:i, value:questions[i].question});
                        for(let j=0; j<answers.length; j++){
                            if(answers[j].question_id == questions[i].id){
                                let max_index = this.answerList[i].length;
                                this.answerList[i].push({id: max_index, value:answers[j].answer});
                            }
                        }
                    }
                    this.maxId = questions.length;
                    this.getAnswerSeries();
                    setTimeout(function(){
                        //$("#product_0").select2().val(["1","8"]).trigger("change");
                        //$('#product_0').val([1,8]);
                        for (let k=0; k<ref.answerSeries.length; k++){
                            let products = pairs[k].product_ids;
                            products = products.split(",");
                            $('#product_'+k).select2().val(products).trigger("change");
                        }
                    }, 500);

                }
            }).catch((error) => {
                console.log("get setting error")
            })
        }
    },
    mounted() {
        this.getSetting();
        for (let i=0; i<10; i++){
            this.answerList[i] = [];
        }
        for (let i=0; i<50; i++){
            this.recommend_product[i] = [];
        }
        this.getPreviousData()
    }
});
