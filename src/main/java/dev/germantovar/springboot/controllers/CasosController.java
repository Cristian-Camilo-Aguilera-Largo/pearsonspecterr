package dev.germantovar.springboot.controllers;

import dev.germantovar.springboot.entities.Casos;
import dev.germantovar.springboot.entities.Abogados;
import dev.germantovar.springboot.entities.Clientes;
import dev.germantovar.springboot.repository.CasosRepository;
import dev.germantovar.springboot.repository.AbogadosRepository;
import dev.germantovar.springboot.repository.ClientesRepository;
import dev.germantovar.springboot.services.ICasosService;
import io.swagger.annotations.ApiOperation;
import io.swagger.annotations.ApiParam;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.core.io.InputStreamResource;
import org.springframework.http.HttpHeaders;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.List;

@RestController
public class CasosController {

    @Autowired
    private ICasosService service;

    @Autowired
    CasosRepository casosRepository;

    @Autowired
    AbogadosRepository abogadosRepository;

    @Autowired
    ClientesRepository clientesRepository;

    @GetMapping("tipificacion1")
    public List<Casos> getAll() {
        return service.getAll();
    }

    @PostMapping("envio")
    public ResponseEntity<?> save(@RequestBody CasosRequest casosRequest) {
        Abogados abogado = abogadosRepository.findById(casosRequest.getIdAbogado())
                .orElseThrow(() -> new RuntimeException("Abogado no encontrado"));
        Clientes cliente = clientesRepository.findById(casosRequest.getIdClientes())
                .orElseThrow(() -> new RuntimeException("Cliente no encontrado"));

        Casos caso = new Casos();
        caso.setAbogados(abogado);
        caso.setClientes(cliente);
        caso.setCaso(casosRequest.getCaso());
        caso.setDescripcion(casosRequest.getDescripcion());
        caso.setFecha_ic(casosRequest.getFechaIc());
        caso.setEstado(casosRequest.getEstado());
        caso.setFecha_ct(casosRequest.getFechaCt());

        service.save(caso);
        return ResponseEntity.ok(caso);
    }

    @GetMapping("/casos/{idAbogado}")
    public List<Casos> getCasosByAbogado(@PathVariable Long idAbogado) {
        return casosRepository.findByAbogados_Id(idAbogado);
    }

    @GetMapping("/cliente/{idCliente}")
    public List<Casos> getCasosByCliente(@PathVariable Long idCliente) {
        return casosRepository.findByClientes_Id(idCliente);
    }

    @ApiOperation(value = "Subir un archivo .zip para un caso")
    @PostMapping(value = "/casos/{id}/subir-archivo", consumes = "multipart/form-data")
    public ResponseEntity<?> subirArchivo(
            @PathVariable Long id,
            @ApiParam(value = "Archivo .zip a subir", required = true) @RequestPart("file") MultipartFile file) {

        Casos caso = casosRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Caso no encontrado con ID: " + id));

        String carpetaDestino = "uploads/";
        Path pathDestino = Paths.get(carpetaDestino + file.getOriginalFilename());

        try {
            Files.createDirectories(pathDestino.getParent());
            Files.write(pathDestino, file.getBytes());
            caso.setArchivo(pathDestino.toString());
            casosRepository.save(caso);

            return ResponseEntity.ok("Archivo subido y guardado correctamente para el caso con ID: " + id);
        } catch (IOException e) {
            return ResponseEntity.status(500).body("Error al subir el archivo: " + e.getMessage());
        }
    }

    private final String fileStorageLocation = "C:\\xampp\\htdocs\\pearsonspecterr\\uploads"; // Cambia esto a tu directorio de archivos

    @GetMapping("/files/uploads/{filename:.+}")
    public ResponseEntity<InputStreamResource> downloadFile(@PathVariable String filename) {
        try {
            Path filePath = Paths.get(fileStorageLocation).resolve(filename).normalize();
            File file = filePath.toFile();

            if (file.exists() && file.isFile()) {
                InputStreamResource resource = new InputStreamResource(new FileInputStream(file));

                return ResponseEntity.ok()
                        .header(HttpHeaders.CONTENT_DISPOSITION, "attachment; filename=\"" + file.getName() + "\"")
                        .header(HttpHeaders.CONTENT_TYPE, Files.probeContentType(filePath))
                        .body(resource);
            } else {
                return ResponseEntity.status(HttpStatus.NOT_FOUND).build();
            }
        } catch (IOException ex) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).build();
        }
    }

    @DeleteMapping("tipificacion1/eliminar/{id}")
    public void remove(@PathVariable String id) {
        service.remove(Long.parseLong(id)); // No es necesario convertir, ya que es Long
    }
}
