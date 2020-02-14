from django.shortcuts import render, redirect
from employee.forms import EmployeeForm  
from employee.models import (Employee,CrudUser)
from django.http import JsonResponse
# Create your views here.
def emp(request):  
    #print(request.method)
    if request.method == "POST":  
        form = EmployeeForm(request.POST)  
        if form.is_valid():  
            try:  
                form.save()  
                return redirect('/show')  
            except:  
                pass  
    else:  
        form = EmployeeForm()  
    return render(request,'curd/index.html',{'form':form})
def show(request):
    employees = Employee.objects.all()
    return render(request,"curd/show.html",{'employees':employees})
def edit(request, id):  
    employee = Employee.objects.get(id=id)  
    return render(request,'curd/edit.html', {'employee':employee})
def update(request, id):  
    employee = Employee.objects.get(id=id)  
    form = EmployeeForm(request.POST, instance = employee)  
    if form.is_valid():  
        form.save()  
        return redirect("/show")  
    return render(request, 'curd/edit.html', {'employee': employee})
def destroy(request, id):  
    employee = Employee.objects.get(id=id)  
    employee.delete()  
    return redirect("/show")
def home(request):
        return render(request,"website/index.html")
def about(request):
        return render(request,"website/about.html") 
def products(request):
        return render(request,"website/products.html")
def store(request):
        return render(request,"website/store.html")
def ajaxcurd(request):
    users = CrudUser.objects.all()
    return render(request, "ajaxcurd/crud.html", {'users': users})
def ajaxcreate(request):
    name1 = request.POST.get('name', None)
    address1 = request.POST.get('address', None)
    age1 = request.POST.get('age', None)

    obj = CrudUser.objects.create(
        name=name1,
        address=address1,
        age=age1
    )

    user = {'id': obj.id, 'name': obj.name, 'address': obj.address, 'age': obj.age}

    data = {
        'user': user
    }
    return JsonResponse(data)
def ajaxupdate(request):
    id1 = request.POST.get('id', None)
    name1 = request.POST.get('name', None)
    address1 = request.POST.get('address', None)
    age1 = request.POST.get('age', None)

    obj = CrudUser.objects.get(id=id1)
    obj.name = name1
    obj.address = address1
    obj.age = age1
    obj.save()

    user = {'id': obj.id, 'name': obj.name, 'address': obj.address, 'age': obj.age}

    data = {
        'user': user
    }
    return JsonResponse(data)

def  ajaxdelete(request):
        id1 = request.POST.get('id', None)
        CrudUser.objects.get(id=id1).delete()
        data = {
            'deleted': True
        }
        return JsonResponse(data)