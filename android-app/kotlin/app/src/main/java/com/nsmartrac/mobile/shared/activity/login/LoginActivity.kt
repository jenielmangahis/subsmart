package com.nsmartrac.mobile.shared.activity.login

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.Button
import com.nsmartrac.mobile.R
import com.nsmartrac.mobile.shared.activity.home.HomeActivity

class LoginActivity : AppCompatActivity() {


    private lateinit var btnSubmit: Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        initViews()
    }

    // MARK: - Functions -

    private fun initViews() {

        btnSubmit = findViewById(R.id.btnSubmit)

        btnSubmit.setOnClickListener(View.OnClickListener {

            val intent = Intent(this, HomeActivity::class.java)
            startActivity(intent)
        })
    }
}
