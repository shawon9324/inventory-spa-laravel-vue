/*-------Import Child Class[TOKEN+APPSTORAGE]------*/
import Token from './Token'
import AppStorage from './AppStorage'

class User{
    responseAfterLogin(res){
        const access_token  = res.data.access_token;
        const user_name  = res.data.name;
        if(Token.isValid(access_token)){
            AppStorage.store(access_token,user_name)
        }
    }
    hasToken(){
        const storeToken = localStorage.getItem('token')
        if(storeToken){
            return Token.isValid(storeToken) ? true : false
        }
        return false
    }
    loggedIn(){
        return this.hasToken()
    }
    name(){
        if(this.loggedIn()){
            return localStorage.getItem('user')
        }
    }
    user_id(){
        if(this.loggedIn()){
            const payload = Token.payload(localStorage.getItem('token')) 
            return payload.sub
        }
        return false
    }
}
export default  User = new User();