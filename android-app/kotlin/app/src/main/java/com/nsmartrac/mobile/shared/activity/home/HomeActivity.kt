package com.nsmartrac.mobile.shared.activity.home

import android.content.res.Configuration
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import android.view.Menu
import android.view.MenuItem
import android.widget.Toast
import androidx.appcompat.app.ActionBarDrawerToggle
import androidx.appcompat.widget.Toolbar
import androidx.core.view.GravityCompat
import androidx.drawerlayout.widget.DrawerLayout
import com.google.android.material.navigation.NavigationView
import com.nsmartrac.mobile.R
import androidx.core.content.ContextCompat
import info.androidhive.fontawesome.FontDrawable


class HomeActivity : AppCompatActivity(), NavigationView.OnNavigationItemSelectedListener {

    private lateinit var drawer: DrawerLayout
    private lateinit var toggle: ActionBarDrawerToggle
    private lateinit var toolbar: Toolbar
    private lateinit var navigationView: NavigationView

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_home)

        initViews()
    }

    override fun onPostCreate(savedInstanceState: Bundle?) {
        super.onPostCreate(savedInstanceState)
        toggle.syncState()
    }

    override fun onCreateOptionsMenu(menu: Menu): Boolean {
        // Inflate the menu; this adds items to the action bar if it is present.
        menuInflater.inflate(R.menu.home, menu)
        return true
    }

    override fun onConfigurationChanged(newConfig: Configuration?) {
        super.onConfigurationChanged(newConfig)
        toggle.onConfigurationChanged(newConfig)
    }

    override fun onOptionsItemSelected(item: MenuItem?): Boolean {
        if (toggle.onOptionsItemSelected(item)) {
            return true
        }
        return super.onOptionsItemSelected(item)
    }

    override fun onNavigationItemSelected(item: MenuItem): Boolean {

        when (item.itemId) {
            R.id.nav_home -> Toast.makeText(this, "Clicked item one", Toast.LENGTH_SHORT).show()
            R.id.nav_customers -> Toast.makeText(this, "Clicked item two", Toast.LENGTH_SHORT).show()
            R.id.nav_quick_links -> Toast.makeText(this, "Clicked item three", Toast.LENGTH_SHORT).show()
            R.id.nav_business_contacts -> Toast.makeText(this, "Clicked item four", Toast.LENGTH_SHORT).show()
        }
        drawer.closeDrawer(GravityCompat.START)
        return true
    }

    override fun onBackPressed() {
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START)
        } else {
            super.onBackPressed()
        }
    }

    // MARK: - Functions -

    private fun initViews() {

        toolbar = findViewById(R.id.toolbar)
        setSupportActionBar(toolbar)

        drawer = findViewById(R.id.drawer_layout)
        toggle = ActionBarDrawerToggle(this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close)
        drawer.addDrawerListener(toggle)
        supportActionBar?.setDisplayHomeAsUpEnabled(true)
        supportActionBar?.setHomeButtonEnabled(true)

        navigationView = findViewById(R.id.nav_view)
        navigationView.setNavigationItemSelectedListener(this)

        val icons = intArrayOf(
                            R.string.fa_home_solid,
                            R.string.fa_user_solid,
                            R.string.fa_link_solid,
                            R.string.fa_address_book_solid,
                            R.string.fa_clipboard_list_solid,
                            R.string.fa_tasks_solid,
                            R.string.fa_dolly_flatbed_solid,
                            R.string.fa_map_solid,
                            R.string.fa_calculator_solid,
                            R.string.fa_sign_solid,
                            R.string.fa_tools_solid,
                            R.string.fa_bell_solid,
                            R.string.fa_user_circle_solid,
                            R.string.fa_cog_solid,
                            R.string.fa_briefcase_solid,
                            R.string.fa_sign_out_alt_solid)

        renderMenuIcons(navigationView.menu, icons, true, false)
    }

    private fun renderMenuIcons(menu: Menu, icons: IntArray, isSolid: Boolean, isBrand: Boolean) {
        for (i in 0 until menu.size()) {
            val menuItem = menu.getItem(i)
            if (!menuItem.hasSubMenu()) {
                val drawable = FontDrawable(this, icons[i], isSolid, isBrand)
                drawable.setTextColor(ContextCompat.getColor(this, R.color.white))
                drawable.textSize = 20f
                menu.getItem(i).icon = drawable
            }
        }
    }
}
