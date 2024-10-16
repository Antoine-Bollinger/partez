import copyCode from "./components/copyCode"
import Login from "./views/login"

class App {
    static hello() {
        console.log("🔥 Welcome to partez! 🔥\r\nPlease feel free to edit js in public/js directory.")
    }

    static init() {
        new copyCode
        new Login
    }
}

App.hello()
App.init()
