from django import forms  
from employee.models import (Employee,CrudUser)
class EmployeeForm(forms.ModelForm):  
    class Meta:  
        model = Employee  
        fields = "__all__"
class UserForm(forms.ModelForm):
    class Meta:
        model = CrudUser
        fields = "__all__"