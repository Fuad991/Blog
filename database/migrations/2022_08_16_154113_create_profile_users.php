<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('province');
            $table->integer('user_id')->unsigned();
            $table->string('gender');
            $table->longText('bio');
            $table->longText('cv');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')//عشان نعرف التيبل انه هاذ الكولم تابع لتيبل اليوزر وهو غريب عنه
            ->onDelete('cascade');//عشان لما نحذف يوزر ما يعطينا ايرور لانه مربوط مع تيبل البروفايل ولما احط هاي الجملة بصير يمسح اليوزر والبروفايل تبعه
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_users');
    }
};
