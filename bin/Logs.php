<?php
namespace Abollinger\Bin;

final class Logs
{
    public static function InstallationComplete(

    ) :void {
        echo "\r\r\n🎉 \e[32mCongrats! You've just create a new Partez project!.\n\e[39m";
        echo "💡 \e[39mDon't forget to create a .env file at the root of your project. Please check the .env-example to see what it can contains.\n\e[39m";
        echo "\e[32mNow just run `composer partez` and see the magic happens! 🚀.\n\n\e[39m";
    }
}