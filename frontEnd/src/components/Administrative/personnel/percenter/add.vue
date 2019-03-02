<template>
	<div class="m-l-50 m-t-30 w-900">
		<el-form ref="form" :model="form" :rules="rules" label-width="130px">
			<el-form-item label="用户名" prop="username">
				<el-input v-model.trim="form.username" class="h-40 w-200"></el-input>
			</el-form-item>
			<el-form-item label="密码" prop="password">
				<el-input v-model.trim="form.password" class="h-40 w-200"></el-input>
			</el-form-item>
			<el-form-item label="联系方式" prop="phone">
				<el-input v-model.trim="form.phone" class="h-40 w-200"></el-input>
			</el-form-item>
			<el-form-item label="描述" prop="remark">
				<el-input v-model.trim="form.remark" class="h-40 w-200"></el-input>
			</el-form-item>
			<el-form-item label="状态" prop="status">
				<el-input v-model.trim="form.status" placeholder="1为启动，0为禁用" class="h-40 w-200"></el-input>
			</el-form-item>
			
			<el-form-item>
				<el-button type="primary" @click="add('form')" :loading="isLoading">提交</el-button>
				<el-button @click="goback()">返回</el-button>
			</el-form-item>
		</el-form>
	</div>
</template>
<script>
  import http from '../../../../assets/js/http'
  import fomrMixin from '../../../../assets/js/form_com'

  export default {
    data() {
      return {
        isLoading: false,
        form: {
          username: '',
		  password: '',
		  phone: '',
		  remark: '',
		  status: '',
        },
        rules: {
          username: [
            { required: true, message: '请输入用户名称' }
          ],
		  password: [
            { required: true, message: '请输入密码' }
          ],
		  status: [
            { required: true, message: '请输入状态' }
          ]
        }
      }
    },
    methods: {
      add(form) {
        this.$refs[form].validate((valid) => {
          if (valid) {
            this.isLoading = !this.isLoading
            this.apiPost('admin/percenter', this.form).then((res) => {
              this.handelResponse(res, (data) => {
                _g.toastMsg('success', '添加成功')
                setTimeout(() => {
                  this.goback()
                }, 1500)
              }, () => {
                this.isLoading = !this.isLoading
              })
            })
          }
        })
      },
      getStructures() {
        this.apiGet('admin/percenter').then((res) => {
          this.handelResponse(res, (data) => {
            this.options = this.options.concat(data)
          })
        })
      }
    },
    created() {
      this.getStructures()
    },
    mixins: [http, fomrMixin]
  }
</script>