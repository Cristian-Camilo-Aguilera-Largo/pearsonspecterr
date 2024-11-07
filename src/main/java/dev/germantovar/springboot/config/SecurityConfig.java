package dev.germantovar.springboot.config;

import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityConfigurerAdapter;

@Configuration  // Asegúrate de que la clase esté anotada como @Configuration
@EnableWebSecurity  // Anotación necesaria para habilitar la seguridad web
public class SecurityConfig extends WebSecurityConfigurerAdapter {

    @Override
    protected void configure(HttpSecurity http) throws Exception {
        http
                .csrf().disable() // Deshabilita CSRF temporalmente para permitir DELETE
                .authorizeRequests()
                .anyRequest().permitAll(); // Permite todas las rutas sin autenticación
    }
}
