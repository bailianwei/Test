<template>
	<div class="m-l-50 m-t-30 w-500">
		<el-form ref="form" :model="form" :rules="rules" label-width="130px">
			<el-form-item label="用户名" prop="username">
				<el-input v-model.trim="form.username" class="h-40 w-200" :maxlength=12 :disabled="true"></el-input>
			</el-form-item>
			<el-form-item label="密码" prop="password">
				<el-input v-model.trim="password" class="h-40 w-200"></el-input>
			</el-form-item>
			<el-form-item label="联系方式" prop="phone">
				<el-input v-model.trim="form.phone" class="h-40 w-200"></el-input>
			</el-form-item>
			<el-form-item label="描述" prop="remark">
				<el-input v-model.trim="form.remark" class="h-40 w-200"></el-input>
			</el-form-item>
			<el-form-item label="状态">
				<el-input v-model.trim="form.status" placeholder="1为启用，0为禁用"class="h-40 w-200"></el-input>
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
          username: '',
          phone: '',
          status: '',
          remark: '',
          groups: []
        },
        password: '',
        orgsOptions: [],
        groupOptions: [],
        selectedGroups: [],
        selectedIds: [],
        rules: {
          username: [
            { required: true, message: '请输入用户名' }
          ],
          password: [
            { required: true, message: '请输入真实姓名' }
          ],
          status: [
            { required: true, message: '请选择是否启用' }
          ]
        }
      }
    },
      methods: {
      edit(form) {
        this.form.rules = this.selectedNodes.toString()
  
        
            this.isLoading = !this.isLoading
            this.apiPut('admin/percenter/', this.id, this.form).then((res) => {
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
            this.apiGet('admin/percenter/').then((res) => {
              console.log('groups = ', _g.j2s(res))
              this.handelResponse(res, (data) => {
                resolve(data)
              })
            })
          }
        })
      },
      
      async getCompleteData() {
        this.getAllOrgs()
        this.groupOptions = await this.getAllGroups()
        this.apiGet('admin/percenter/' + this.id).then((res) => {
          console.log('res = ', _g.j2s(res))
          this.handelResponse(res, (data) => {
            this.form.username = data.username
            this.form.password = data.password
            this.form.phone = data.phone
            this.form.remark = data.remark
			this.form.status = data.status
            
          })
       
	   })
      }
	},
    created() {
      this.id = this.$route.params.id
      this.getCompleteData()
    },
    mixins: [http, fomrMixin]

  }
</script>