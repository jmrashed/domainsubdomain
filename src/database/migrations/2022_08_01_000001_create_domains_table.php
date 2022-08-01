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
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain');
            $table->string('description')->nullable();

            // domains 
            $table->string('domain_type')->nullable();
            $table->string('domain_status')->nullable();
            $table->string('domain_created')->nullable();

            // registrar
            $table->string('registrar_name')->nullable();
            $table->string('registrar_url')->nullable();
            $table->string('registrar_whois_server')->nullable();
            $table->string('registrar_referral_url')->nullable();

            // registrant
            $table->string('registrant_name')->nullable();
            $table->string('registrant_organization')->nullable();
            $table->string('registrant_street')->nullable();
            $table->string('registrant_city')->nullable();
            $table->string('registrant_state_province')->nullable();

            // billing
            $table->string('billing_name')->nullable();
            $table->string('billing_organization')->nullable();
            $table->string('billing_street')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state_province')->nullable();

            // nameservers
            $table->string('nameserver')->nullable();
            $table->string('dnssec')->nullable();
            $table->text('raw')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domains');
    }
};
