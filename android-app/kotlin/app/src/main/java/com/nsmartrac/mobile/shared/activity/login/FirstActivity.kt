package com.nsmartrac.mobile.shared.activity.login

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.nsmartrac.mobile.R

class FirstActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_first)

        val intent = Intent(this, LoginActivity::class.java)
        startActivity(intent)
    }
}
