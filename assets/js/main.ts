import copyCode from "./components/copyCode"
import Login from "./views/login"
import { Console } from "./utils/console"

class App {
    static hello() {
        console.log(`%c${Console.printLetters({ text: "partez" })}`, "color:#4F5B93;font-weight:bold;")
        console.log("🔥 Welcome to partez! 🔥\r\nPlease feel free to edit js in public/js directory.")
    }

    static init() {
        new copyCode
        new Login
    }
}

App.hello()
App.init()