import sys
import os
import numpy as np
import btk

os.chdir('/home/lempereur/www/AQM/temp_files2/')
file = 'fichier.json'

NbLowerLimb = 5
NbLeftAngles = (int(sys.argv[1])) * NbLowerLimb
NbRightAngles = (int(sys.argv[2])) * NbLowerLimb
NbMaxAngles = 2500

NbStep = NbMaxAngles / NbLowerLimb

NbLeftFiles = int(NbLeftAngles / NbMaxAngles) #Number of files containing 2500 NbAngles
NbRightFiles =  int(NbRightAngles / NbMaxAngles)


LPelvisAngles = np.zeros((101,3*int(sys.argv[1])))
LHipAngles =  np.zeros((101,3*int(sys.argv[1])))
LKneeAngles =  np.zeros((101,3*int(sys.argv[1])))
LAnkleAngles = np.zeros((101,3*int(sys.argv[1])))
LFootProgressAngles = np.zeros((101,3*int(sys.argv[1])))


RPelvisAngles = np.zeros((101,3*int(sys.argv[2])))
RHipAngles =  np.zeros((101,3*int(sys.argv[2])))
RKneeAngles =  np.zeros((101,3*int(sys.argv[2])))
RAnkleAngles = np.zeros((101,3*int(sys.argv[2])))
RFootProgressAngles = np.zeros((101,3*int(sys.argv[2])))

index = np.zeros((10,), dtype=np.int)


with open(file) as f :
  for line in f :
    if "LPelvisAnglesX" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LPelvisAngles[:,index[0]] = value
	  index[0] = index[0] + 1
    if "LPelvisAnglesY" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LPelvisAngles[:,index[0]] = value
	  index[0] = index[0] + 1
    if "LPelvisAnglesZ" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LPelvisAngles[:,index[0]] = value
	  index[0] = index[0] + 1
    if "LHipAnglesX" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LHipAngles[:,index[1]] = value
	  index[1] = index[1] + 1
    if "LHipAnglesY" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LHipAngles[:,index[1]] = value
	  index[1] = index[1] + 1
    if "LHipAnglesZ" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LHipAngles[:,index[1]] = value
	  index[1] = index[1] + 1
    if "LKneeAnglesX" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LKneeAngles[:,index[2]] = value
	  index[2] = index[2] + 1
    if "LKneeAnglesY" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LKneeAngles[:,index[2]] = value
	  index[2] = index[2] + 1
    if "LKneeAnglesZ" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LKneeAngles[:,index[2]] = value
	  index[2] = index[2] + 1
    if "LAnkleAnglesX" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LAnkleAngles[:,index[3]] = value
	  index[3] = index[3] + 1
    if "LAnkleAnglesY" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LAnkleAngles[:,index[3]] = value
	  index[3] = index[3] + 1
    if "LAnkleAnglesZ" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LAnkleAngles[:,index[3]] = value
	  index[3] = index[3] + 1
    if "LFootProgressAnglesX" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LFootProgressAngles[:,index[4]] = value
	  index[4] = index[4] + 1
    if "LFootProgressAnglesY" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LFootProgressAngles[:,index[4]] = value
	  index[4] = index[4] + 1
    if "LFootProgressAnglesZ" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  LFootProgressAngles[:,index[4]] = value
	  index[4] = index[4] + 1
	  
    if "RPelvisAnglesX" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RPelvisAngles[:,index[5]] = value
	  index[5] = index[5] + 1
    if "RPelvisAnglesY" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RPelvisAngles[:,index[5]] = value
	  index[5] = index[5] + 1
    if "RPelvisAnglesZ" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RPelvisAngles[:,index[5]] = value
	  index[5] = index[5] + 1
    if "RHipAnglesX" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RHipAngles[:,index[6]] = value
	  index[6] = index[6] + 1
    if "RHipAnglesY" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RHipAngles[:,index[6]] = value
	  index[6] = index[6] + 1
    if "RHipAnglesZ" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RHipAngles[:,index[6]] = value
	  index[6] = index[6] + 1
    if "RKneeAnglesX" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RKneeAngles[:,index[7]] = value
	  index[7] = index[7] + 1
    if "RKneeAnglesY" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RKneeAngles[:,index[7]] = value
	  index[7] = index[7] + 1
    if "RKneeAnglesZ" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RKneeAngles[:,index[7]] = value
	  index[7] = index[7] + 1
    if "RAnkleAnglesX" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RAnkleAngles[:,index[8]] = value
	  index[8] = index[8] + 1
    if "RAnkleAnglesY" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RAnkleAngles[:,index[8]] = value
	  index[8] = index[8] + 1
    if "RAnkleAnglesZ" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RAnkleAngles[:,index[8]] = value
	  index[8] = index[8] + 1
    if "RFootProgressAnglesX" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RFootProgressAngles[:,index[9]] = value
	  index[9] = index[9] + 1
    if "RFootProgressAnglesY" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RFootProgressAngles[:,index[9]] = value
	  index[9] = index[9] + 1
    if "RFootProgressAnglesZ" in line :
	  temp = line.split('=')
	  temp = temp[1].split('\n')
	  value = temp[0].split(',')
	  RFootProgressAngles[:,index[9]] = value
	  index[9] = index[9] + 1



if NbLeftFiles < 1 and NbRightFiles < 1 :
    newAcq = btk.btkAcquisition()
    newAcq.Init(0,101, 0,1)
    newAcq.SetPointFrequency(100)
    for num in range(int(sys.argv[1])) : 
      label = "LPelvisAngles" + str(num+1)
      newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
      newpoint.SetValues(LPelvisAngles[:,range(num*3,num*3+2+1)])
      newpoint.SetType(btk.btkPoint.Angle)
      newAcq.AppendPoint(newpoint)
  
      label = "LHipAngles" + str(num+1)
      newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
      newpoint.SetValues(LHipAngles[:,range(num*3,num*3+2+1)])
      newpoint.SetType(btk.btkPoint.Angle)
      newAcq.AppendPoint(newpoint)
  
      label = "LKneeAngles" + str(num+1)
      newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
      newpoint.SetValues(LKneeAngles[:,range(num*3,num*3+2+1)])
      newpoint.SetType(btk.btkPoint.Angle)
      newAcq.AppendPoint(newpoint)
  
      label = "LAnkleAngles" + str(num+1)
      newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
      newpoint.SetValues(LAnkleAngles[:,range(num*3,num*3+2+1)])
      newpoint.SetType(btk.btkPoint.Angle)
      newAcq.AppendPoint(newpoint)
  
      label = "LFootProgressAngles" + str(num+1)
      newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
      newpoint.SetValues(LFootProgressAngles[:,range(num*3,num*3+2+1)])
      newpoint.SetType(btk.btkPoint.Angle)
      newAcq.AppendPoint(newpoint)
  
    for num in range(int(sys.argv[2])) : 
      label = "RPelvisAngles" + str(num+1)
      newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
      newpoint.SetValues(RPelvisAngles[:,range(num*3,num*3+2+1)])
      newpoint.SetType(btk.btkPoint.Angle)
      newAcq.AppendPoint(newpoint)
  
      label = "RHipAngles" + str(num+1)
      newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
      newpoint.SetValues(RHipAngles[:,range(num*3,num*3+2+1)])
      newpoint.SetType(btk.btkPoint.Angle)
      newAcq.AppendPoint(newpoint)
  
      label = "RKneeAngles" + str(num+1)
      newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
      newpoint.SetValues(RKneeAngles[:,range(num*3,num*3+2+1)])
      newpoint.SetType(btk.btkPoint.Angle)
      newAcq.AppendPoint(newpoint)
  
      label = "RAnkleAngles" + str(num+1)
      newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
      newpoint.SetValues(RAnkleAngles[:,range(num*3,num*3+2+1)])
      newpoint.SetType(btk.btkPoint.Angle)
      newAcq.AppendPoint(newpoint)
  
      label = "RFootProgressAngles" + str(num+1)
      newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
      newpoint.SetValues(RFootProgressAngles[:,range(num*3,num*3+2+1)])
      newpoint.SetType(btk.btkPoint.Angle)
      newAcq.AppendPoint(newpoint)
  

    writer = btk.btkAcquisitionFileWriter()
    writer.SetInput(newAcq)
    writer.SetFilename("output.c3d")
    writer.Update()

if NbLeftFiles >= 1 :
    for L in range(NbLeftFiles):
      newAcq = btk.btkAcquisition()
      newAcq.Init(0,101, 0,1)
      newAcq.SetPointFrequency(100)
	  
      for num in range(L*NbStep,(L+1)*NbStep) : 
        label = "LPelvisAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(LPelvisAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "LHipAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(LHipAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "LKneeAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(LKneeAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "LAnkleAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(LAnkleAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "LFootProgressAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(LFootProgressAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
      writer = btk.btkAcquisitionFileWriter()
      writer.SetInput(newAcq)
      if L==0:
        writer.SetFilename("output.c3d")
      else:
        writer.SetFilename("output"+str(L)+".c3d")
      writer.Update()
    L = L +1
    newAcq = btk.btkAcquisition()
    newAcq.Init(0,101, 0,1)
    newAcq.SetPointFrequency(100)
    for num in range(L*NbStep,int(sys.argv[1])) : 
        label = "LPelvisAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(LPelvisAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "LHipAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(LHipAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "LKneeAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(LKneeAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "LAnkleAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(LAnkleAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "LFootProgressAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(LFootProgressAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
    writer = btk.btkAcquisitionFileWriter()
    writer.SetInput(newAcq)
    writer.SetFilename("output"+str(L)+".c3d")
    writer.Update()

if NbRightFiles >= 1 :
    for R in range(NbRightFiles):
      newAcq = btk.btkAcquisition()
      newAcq.Init(0,101, 0,1)
      newAcq.SetPointFrequency(100)
	  
      for num in range(R*NbStep,(R+1)*NbStep) : 
        label = "RPelvisAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(RPelvisAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "RHipAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(RHipAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "RKneeAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(RKneeAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "RAnkleAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(RAnkleAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "RFootProgressAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(RFootProgressAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
      writer = btk.btkAcquisitionFileWriter()
      writer.SetInput(newAcq)
      writer.SetFilename("output"+str(L+R+1)+".c3d")
      writer.Update()
    R = R +1
    newAcq = btk.btkAcquisition()
    newAcq.Init(0,101, 0,1)
    newAcq.SetPointFrequency(100)
    for num in range(R*NbStep,int(sys.argv[2])) : 
        label = "RPelvisAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(RPelvisAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "RHipAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(RHipAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "RKneeAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(RKneeAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "RAnkleAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(RAnkleAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
  
        label = "RFootProgressAngles" + str(num+1)
        newpoint = btk.btkPoint(label, newAcq.GetPointFrameNumber())
        newpoint.SetValues(RFootProgressAngles[:,range(num*3,num*3+2+1)])
        newpoint.SetType(btk.btkPoint.Angle)
        newAcq.AppendPoint(newpoint)
    writer = btk.btkAcquisitionFileWriter()
    writer.SetInput(newAcq)
    writer.SetFilename("output"+str(L+R+1)+".c3d")
    writer.Update()  
