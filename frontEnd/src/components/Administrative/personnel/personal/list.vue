<template>
	
	<div class="m-l-50 m-t-30 w-500">
		<el-form ref="form" :model="form" :rules="rules" label-width="130px">
			<el-form-item label="用户">
				<el-input v-model.trim="username" class="h-40 w-200" :maxlength=12 :disabled="true"></el-input>
			</el-form-item>
			<el-form-item label="姓名">
				<el-input v-model.trim="form.name" class="h-40 w-200" ></el-input>
			</el-form-item>
			<el-form-item label="性别">
				<el-input v-model.trim="form.sex" class="h-40 w-200" ></el-input>
			</el-form-item>
			<el-form-item label="手机">
				<el-input v-model.trim="form.iphone" class="h-40 w-200" ></el-input>
			</el-form-item>
			<el-form-item label="地址">
				<el-input v-model.trim="form.address" class="h-40 w-200" ></el-input>
			</el-form-item>
			<el-form-item>
				<el-button type="primary" @click="edit('form')" :loading="isLoading">提交</el-button>
				<el-button @click="goback()">返回</el-button>
			</el-form-item>
		</el-form>
	</div>
</template>
<style>
	.form-checkbox:first-child{
		margin-left: 15px;
	}
</style>
<script>
  import http from '../../../../assets/js/http'
  import fomrMixin from '../../../../assets/js/form_com'

  export default {
    data() {
      return {
        isLoading: false,
        id: null,
        form: {
          name: '',
		  sex: '',
          iphone: '',
          address: null,
        },
        password: '',
        orgsOptions: [],
        groupOptions: [],
        selectedGroups: [],
        selectedIds: [],
		selectedNodes: [],
        rules: {
          username: [
            { required: true, message: '请输入用户名' }
          ],
          realname: [
            { required: true, message: '请输入真实姓名' }
          ],
          structure_id: [
            { required: true, message: '请选择用户所属组织架构' }
          ]
        }
      }
    },
    methods: {
      edit(form) {
        this.form.rules = this.selectedNodes.toString()
  
        
            this.isLoading = !this.isLoading
            this.apiPut('admin/personal/', this.id, this.form).then((res) => {
              this.handelResponse(res, (data) => {
                _g.toastMsg('success', '编辑成功')
                setTimeout(() => {
                  this.goback()
                }, 1500)
              }, () => {
                this.isLoading = !this.isLoading
              })
            })
          
       
      },
      getAllGroups() {
        return new Promise((resolve, reject) => {
          let data = store.state.userGroups
          if (data && data.length) {
            resolve(data)
          } else {
            this.apiGet('admin/groups').then((res) => {
              
              this.handelResponse(res, (data) => {
                resolve(data)
              })
            })
          }
        })
      },
      async getCompleteData() {
        this.groupOptions = await this.getAllGroups()
        this.apiGet('admin/personal/' + this.id).then((res) => {
          console.log('res = ', _g.j2s(res))
          this.handelResponse(res, (data) => {
            this.form.name = data.name
            this.form.iphone = data.iphone
            this.form.address = data.address
			 this.form.sex = data.sex
           
          })
        })
      }
    },
    created() {
	  this.getCompleteData()
      this.id = Lockr.get('userInfo').id
	  this.username = Lockr.get('userInfo').username
	  this.name = this.form.name
      
    },
    mixins: [http, fomrMixin]
  }
</script>