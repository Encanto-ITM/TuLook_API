from django.db import models
from django.utils import timezone
from phonenumber_field.modelfields import PhoneNumberField

# Create your models here.
class ProfesionUsuario(models.Model):
    nombre = models.CharField(max_length=100, null=False, unique=True)
    detalle = models.CharField(max_length=200, null=True, blank=True)
    
    def __str__(self) -> str:
        return self.nombre.__str__()

    class Meta:
        verbose_name_plural = "profesiones"
        
class TipoCuenta(models.Model):
    nombre = models.CharField(max_length=100, null=False, unique=True)
    detalle = models.CharField(max_length=200, null=True, blank=True)
    
    def __str__(self) -> str:
        return self.nombre.__str__()

    class Meta:
        verbose_name_plural = "tipos"
        
class Prestaciones(models.Model):
    nombre = models.CharField(max_length=100, null=False, unique=True)
    detalle = models.CharField(max_length=200, null=True, blank=True)
    
    def __str__(self) -> str:
        return self.nombre.__str__()

    class Meta:
        verbose_name_plural = "prestaciones"
        
class Usuario(models.Model):
    nombre = models.CharField(max_length=100, null=False)
    apellidos = models.CharField(max_length=100, null=False)
    profesion = models.ForeignKey(ProfesionUsuario, on_delete=models.DO_NOTHING, null=False, blank=False)
    correo = models.EmailField("Correo electrónico", max_length=254)
    numContacto = PhoneNumberField("teléfono", region="CR", unique=True)
    isContactPublico = models.IntegerField("¿El contacto es público?", default=0)  # 0 para no público, 1 para público
    tipoCuenta = models.ForeignKey(TipoCuenta, null=False, blank=False, on_delete=models.DO_NOTHING)
    isActive = models.IntegerField(default=1, null=False) # 0 para inactivo, 1 para activo
    create_at = models.DateTimeField(auto_now_add=True)
    lastLogin = models.DateTimeField("Último inicio de sesión", default=timezone.now)
    
    def __str__(self):
        return f"{self.nombre} {self.apellidos}"
    
    def login(self):
        self.lastLogin = timezone.now()
        self.save()
    
    class Meta:
        verbose_name_plural = "usuarios"
     

class Servicio(models.Model):
    nombre = models.CharField(max_length=200, null=False, blank=False)
    encargado = models.ForeignKey(Usuario, null=False, blank=False, on_delete=models.DO_NOTHING)
    detalles = models.TextField(max_length=500, null=False, blank=False)
    ubicacion = models.TextField(max_length=500, null=True, blank=True)
    horario = models.TextField(max_length=500, null=False, blank=False)
    
    def __str__(self):
        return f"{self.nombre}"
    
    class Meta:
        verbose_name_plural = "servicios"
        
class Prestaciones(models.Model):
    nombre = models.CharField(max_length=100, null=False, unique=True)
    detalle = models.CharField(max_length=200, null=True, blank=True)
    
    def __str__(self):
        return f"{self.nombre}"
    
    class Meta:
        verbose_name_plural = "prestaciones"
        
class Servicio_has_prestaciones(models.Model):
    servicio = models.ForeignKey(Servicio, null=False, on_delete=models.DO_NOTHING)
    prestaciones = models.ForeignKey(Prestaciones, null=False, on_delete=models.DO_NOTHING)
    
    def __str__(self):
        return f"{self.servicio} - {self.prestaciones}"