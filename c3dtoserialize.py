
import sys
import os
import numpy as np
import btk


def timeSequenceNormalisation(Nrow,data):
#Normalisation of an array
#parameters:
#- `Nrow` (double) : number of interval
#- `data` (numpy.array(m,n)) : data

  ncol = 1#data.shape[1]   
  out = np.zeros((Nrow,ncol))
  out = np.interp(np.linspace(0, 100, Nrow), np.linspace(0, 100, data.size), data)
#for i in range(0,ncol):
#  out[:,i] = np.interp(np.linspace(0, 100, Nrow), np.linspace(0, 100, data.shape[0]), data[:,i])

  return out
  
  
  
  

os.chdir('/home/lempereur/www/AQM/temp_files')
listdir = os.listdir('.')
list = []
for file in listdir:
  if file.endswith(".c3d"):
    list.append(file)

acq = []
for i in range(len(list)):
  reader = btk.btkAcquisitionFileReader()
  reader.SetFilename(list[i])
  reader.Update() 
  acq.append(reader.GetOutput())
	






nb_cycle_gauche_cinetique = 0
nb_cycle_droit_cinetique = 0

LPelvisAnglesNormaliseListX = np.array([])
LPelvisAnglesNormaliseListY = np.array([])
LPelvisAnglesNormaliseListZ = np.array([])
LHipAnglesNormaliseListX = np.array([])
LHipAnglesNormaliseListY = np.array([])
LHipAnglesNormaliseListZ = np.array([])
LKneeAnglesNormaliseListX = np.array([])
LKneeAnglesNormaliseListY = np.array([])
LKneeAnglesNormaliseListZ = np.array([])
LAnkleAnglesNormaliseListX = np.array([])
LAnkleAnglesNormaliseListY = np.array([])
LAnkleAnglesNormaliseListZ = np.array([])
LFootProgressAnglesNormaliseListX = np.array([])
LFootProgressAnglesNormaliseListY = np.array([])
LFootProgressAnglesNormaliseListZ = np.array([])

RPelvisAnglesNormaliseListX = np.array([])
RPelvisAnglesNormaliseListY = np.array([])
RPelvisAnglesNormaliseListZ = np.array([])
RHipAnglesNormaliseListX = np.array([])
RHipAnglesNormaliseListY = np.array([])
RHipAnglesNormaliseListZ = np.array([])
RKneeAnglesNormaliseListX = np.array([])
RKneeAnglesNormaliseListY = np.array([])
RKneeAnglesNormaliseListZ = np.array([])
RAnkleAnglesNormaliseListX = np.array([])
RAnkleAnglesNormaliseListY = np.array([])
RAnkleAnglesNormaliseListZ = np.array([])
RFootProgressAnglesNormaliseListX = np.array([])
RFootProgressAnglesNormaliseListY = np.array([])
RFootProgressAnglesNormaliseListZ = np.array([])

for i in range(len(list)):
  PoseTalonGauche = []
  PoseTalonDroit = []
  DecollementPiedGauche = []
  DecollementPiedDroit = []

  for it in btk.Iterate(acq[i].GetEvents()):
    if (it.GetLabel() == "Foot Strike") and (it.GetContext() == "Left"):
	  PoseTalonGauche.append(it.GetFrame())
    if (it.GetLabel() == "Foot Strike") and (it.GetContext() == "Right"):
  	PoseTalonDroit.append(it.GetFrame())
    if (it.GetLabel() == "Foot Off") and (it.GetContext() == "Left"):
  	DecollementPiedGauche.append(it.GetFrame())
    if (it.GetLabel() == "Foot Off") and (it.GetContext() == "Right"):
  	DecollementPiedDroit.append(it.GetFrame())

  PoseTalonGauche.sort()
  PoseTalonDroit.sort()
  DecollementPiedGauche.sort()
  DecollementPiedDroit.sort()
  
  nb_cycle_gauche_cinematique = len(PoseTalonGauche) - 1
  nb_cycle_droit_cinematique = len(PoseTalonDroit) - 1

  cycle_gauche_cinematique_Attaque_Debut = []
  cycle_gauche_cinematique_Attaque_Fin = []
  cycle_droit_cinematique_Attaque_Debut = []
  cycle_droit_cinematique_Attaque_Fin = []




  LPelvisAngles = acq[i].GetPoint("LPelvisAngles").GetValues()
  LHipAngles = acq[i].GetPoint("LHipAngles").GetValues()
  LKneeAngles = acq[i].GetPoint("LKneeAngles").GetValues()
  LAnkleAngles = acq[i].GetPoint("LAnkleAngles").GetValues()
  LFootProgressAngles = acq[i].GetPoint("LFootProgressAngles").GetValues()

  RPelvisAngles = acq[i].GetPoint("RPelvisAngles").GetValues()
  RHipAngles = acq[i].GetPoint("RHipAngles").GetValues()
  RKneeAngles = acq[i].GetPoint("RKneeAngles").GetValues()
  RAnkleAngles = acq[i].GetPoint("RAnkleAngles").GetValues()
  RFootProgressAngles = acq[i].GetPoint("RFootProgressAngles").GetValues()


  for k in range(nb_cycle_gauche_cinematique):
    cycle_gauche_cinematique_Attaque_Debut.append(PoseTalonGauche[k])
    cycle_gauche_cinematique_Attaque_Fin.append(PoseTalonGauche[k+1])
	

    LPelvisAnglesNormaliseX = timeSequenceNormalisation(101,LPelvisAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),0])
    LPelvisAnglesNormaliseY = timeSequenceNormalisation(101,LPelvisAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),1])
    LPelvisAnglesNormaliseZ = timeSequenceNormalisation(101,LPelvisAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),2])

    LHipAnglesNormaliseX = timeSequenceNormalisation(101,LHipAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),0])
    LHipAnglesNormaliseY = timeSequenceNormalisation(101,LHipAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),1])
    LHipAnglesNormaliseZ = timeSequenceNormalisation(101,LHipAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),2])

    LKneeAnglesNormaliseX = timeSequenceNormalisation(101,LKneeAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),0])
    LKneeAnglesNormaliseY = timeSequenceNormalisation(101,LKneeAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),1])
    LKneeAnglesNormaliseZ = timeSequenceNormalisation(101,LKneeAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),2])	

    LAnkleAnglesNormaliseX = timeSequenceNormalisation(101,LAnkleAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),0])
    LAnkleAnglesNormaliseY = timeSequenceNormalisation(101,LAnkleAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),1])
    LAnkleAnglesNormaliseZ = timeSequenceNormalisation(101,LAnkleAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),2])

    LFootProgressAnglesNormaliseX = timeSequenceNormalisation(101,LFootProgressAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),0])
    LFootProgressAnglesNormaliseY = timeSequenceNormalisation(101,LFootProgressAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),1])
    LFootProgressAnglesNormaliseZ = timeSequenceNormalisation(101,LFootProgressAngles[cycle_gauche_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_gauche_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),2])

    LPelvisAnglesNormaliseListX = np.append(LPelvisAnglesNormaliseListX,LPelvisAnglesNormaliseX,axis=0)
    LPelvisAnglesNormaliseListY = np.append(LPelvisAnglesNormaliseListY,LPelvisAnglesNormaliseY,axis=0)
    LPelvisAnglesNormaliseListZ = np.append(LPelvisAnglesNormaliseListZ,LPelvisAnglesNormaliseZ,axis=0)	

    LHipAnglesNormaliseListX = np.append(LHipAnglesNormaliseListX,LHipAnglesNormaliseX,axis=0)
    LHipAnglesNormaliseListY = np.append(LHipAnglesNormaliseListY,LHipAnglesNormaliseY,axis=0)
    LHipAnglesNormaliseListZ = np.append(LHipAnglesNormaliseListZ,LHipAnglesNormaliseZ,axis=0)

    LKneeAnglesNormaliseListX = np.append(LKneeAnglesNormaliseListX,LKneeAnglesNormaliseX,axis=0)
    LKneeAnglesNormaliseListY = np.append(LKneeAnglesNormaliseListY,LKneeAnglesNormaliseY,axis=0)
    LKneeAnglesNormaliseListZ = np.append(LKneeAnglesNormaliseListZ,LKneeAnglesNormaliseZ,axis=0)

    LAnkleAnglesNormaliseListX = np.append(LAnkleAnglesNormaliseListX,LAnkleAnglesNormaliseX,axis=0)
    LAnkleAnglesNormaliseListY = np.append(LAnkleAnglesNormaliseListY,LAnkleAnglesNormaliseY,axis=0)
    LAnkleAnglesNormaliseListZ = np.append(LAnkleAnglesNormaliseListZ,LAnkleAnglesNormaliseZ,axis=0)	

    LFootProgressAnglesNormaliseListX = np.append(LFootProgressAnglesNormaliseListX,LFootProgressAnglesNormaliseX,axis=0)
    LFootProgressAnglesNormaliseListY = np.append(LFootProgressAnglesNormaliseListY,LFootProgressAnglesNormaliseY,axis=0)
    LFootProgressAnglesNormaliseListZ = np.append(LFootProgressAnglesNormaliseListZ,LFootProgressAnglesNormaliseZ,axis=0)

  for k in range(nb_cycle_droit_cinematique):
    cycle_droit_cinematique_Attaque_Debut.append(PoseTalonDroit[k])
    cycle_droit_cinematique_Attaque_Fin.append(PoseTalonDroit[k+1])

    RPelvisAnglesNormaliseX = timeSequenceNormalisation(101,RPelvisAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),0])
    RPelvisAnglesNormaliseY = timeSequenceNormalisation(101,RPelvisAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),1])
    RPelvisAnglesNormaliseZ = timeSequenceNormalisation(101,RPelvisAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),2])

    RHipAnglesNormaliseX = timeSequenceNormalisation(101,RHipAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),0])
    RHipAnglesNormaliseY = timeSequenceNormalisation(101,RHipAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),1])
    RHipAnglesNormaliseZ = timeSequenceNormalisation(101,RHipAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),2])

    RKneeAnglesNormaliseX = timeSequenceNormalisation(101,RKneeAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),0])
    RKneeAnglesNormaliseY = timeSequenceNormalisation(101,RKneeAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),1])
    RKneeAnglesNormaliseZ = timeSequenceNormalisation(101,RKneeAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),2])	

    RAnkleAnglesNormaliseX = timeSequenceNormalisation(101,RAnkleAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),0])
    RAnkleAnglesNormaliseY = timeSequenceNormalisation(101,RAnkleAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),1])
    RAnkleAnglesNormaliseZ = timeSequenceNormalisation(101,RAnkleAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),2])

    RFootProgressAnglesNormaliseX = timeSequenceNormalisation(101,RFootProgressAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),0])
    RFootProgressAnglesNormaliseY = timeSequenceNormalisation(101,RFootProgressAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),1])
    RFootProgressAnglesNormaliseZ = timeSequenceNormalisation(101,RFootProgressAngles[cycle_droit_cinematique_Attaque_Debut[k] - acq[i].GetFirstFrame() : cycle_droit_cinematique_Attaque_Fin[k] - acq[i].GetFirstFrame(),2])

    RPelvisAnglesNormaliseListX = np.append(RPelvisAnglesNormaliseListX,RPelvisAnglesNormaliseX,axis=0)
    RPelvisAnglesNormaliseListY = np.append(RPelvisAnglesNormaliseListY,RPelvisAnglesNormaliseY,axis=0)
    RPelvisAnglesNormaliseListZ = np.append(RPelvisAnglesNormaliseListZ,RPelvisAnglesNormaliseZ,axis=0)	

    RHipAnglesNormaliseListX = np.append(RHipAnglesNormaliseListX,RHipAnglesNormaliseX,axis=0)
    RHipAnglesNormaliseListY = np.append(RHipAnglesNormaliseListY,RHipAnglesNormaliseY,axis=0)
    RHipAnglesNormaliseListZ = np.append(RHipAnglesNormaliseListZ,RHipAnglesNormaliseZ,axis=0)

    RKneeAnglesNormaliseListX = np.append(RKneeAnglesNormaliseListX,RKneeAnglesNormaliseX,axis=0)
    RKneeAnglesNormaliseListY = np.append(RKneeAnglesNormaliseListY,RKneeAnglesNormaliseY,axis=0)
    RKneeAnglesNormaliseListZ = np.append(RKneeAnglesNormaliseListZ,RKneeAnglesNormaliseZ,axis=0)

    RAnkleAnglesNormaliseListX = np.append(RAnkleAnglesNormaliseListX,RAnkleAnglesNormaliseX,axis=0)
    RAnkleAnglesNormaliseListY = np.append(RAnkleAnglesNormaliseListY,RAnkleAnglesNormaliseY,axis=0)
    RAnkleAnglesNormaliseListZ = np.append(RAnkleAnglesNormaliseListZ,RAnkleAnglesNormaliseZ,axis=0)	

    RFootProgressAnglesNormaliseListX = np.append(RFootProgressAnglesNormaliseListX,RFootProgressAnglesNormaliseX,axis=0)
    RFootProgressAnglesNormaliseListY = np.append(RFootProgressAnglesNormaliseListY,RFootProgressAnglesNormaliseY,axis=0)
    RFootProgressAnglesNormaliseListZ = np.append(RFootProgressAnglesNormaliseListZ,RFootProgressAnglesNormaliseZ,axis=0)

nb_cycle_gauche = LPelvisAnglesNormaliseListX.size / 101
LPelvisAnglesSerializeX = 'a:101:{'
LPelvisAnglesSerializeY = 'a:101:{'
LPelvisAnglesSerializeZ = 'a:101:{'
LHipAnglesSerializeX = 'a:101:{'
LHipAnglesSerializeY = 'a:101:{'
LHipAnglesSerializeZ = 'a:101:{'
LKneeAnglesSerializeX = 'a:101:{'
LKneeAnglesSerializeY = 'a:101:{'
LKneeAnglesSerializeZ = 'a:101:{'
LAnkleAnglesSerializeX = 'a:101:{'
LAnkleAnglesSerializeY = 'a:101:{'
LAnkleAnglesSerializeZ = 'a:101:{'
LFootProgressAnglesSerializeX = 'a:101:{'
LFootProgressAnglesSerializeY = 'a:101:{'
LFootProgressAnglesSerializeZ = 'a:101:{'

for j in range(0,101):
  LPelvisAnglesSerializeX = LPelvisAnglesSerializeX + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LPelvisAnglesSerializeY = LPelvisAnglesSerializeY + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LPelvisAnglesSerializeZ = LPelvisAnglesSerializeZ + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LHipAnglesSerializeX = LHipAnglesSerializeX + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LHipAnglesSerializeY = LHipAnglesSerializeY + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LHipAnglesSerializeZ = LHipAnglesSerializeZ + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LKneeAnglesSerializeX = LKneeAnglesSerializeX + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LKneeAnglesSerializeY = LKneeAnglesSerializeY + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LKneeAnglesSerializeZ = LKneeAnglesSerializeZ + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LAnkleAnglesSerializeX = LAnkleAnglesSerializeX + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LAnkleAnglesSerializeY = LAnkleAnglesSerializeY + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LAnkleAnglesSerializeZ = LAnkleAnglesSerializeZ + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LFootProgressAnglesSerializeX = LFootProgressAnglesSerializeX + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LFootProgressAnglesSerializeY = LFootProgressAnglesSerializeY + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'
  LFootProgressAnglesSerializeZ = LFootProgressAnglesSerializeZ + 'i:' + str(j) + ';a:' + str(nb_cycle_gauche) + ':{'

  for i in range(1,nb_cycle_gauche+1):
    LPelvisAnglesSerializeX = LPelvisAnglesSerializeX + 'i:' + str(i-1) + ';d:' + str(LPelvisAnglesNormaliseListX[j+101*(i-1)]) + ';'
    LPelvisAnglesSerializeY = LPelvisAnglesSerializeY + 'i:' + str(i-1) + ';d:' + str(LPelvisAnglesNormaliseListY[j+101*(i-1)]) + ';'
    LPelvisAnglesSerializeZ = LPelvisAnglesSerializeZ + 'i:' + str(i-1) + ';d:' + str(LPelvisAnglesNormaliseListZ[j+101*(i-1)]) + ';'
    LHipAnglesSerializeX = LHipAnglesSerializeX + 'i:' + str(i-1) + ';d:' + str(LHipAnglesNormaliseListX[j+101*(i-1)]) + ';'
    LHipAnglesSerializeY = LHipAnglesSerializeY + 'i:' + str(i-1) + ';d:' + str(LHipAnglesNormaliseListY[j+101*(i-1)]) + ';'
    LHipAnglesSerializeZ = LHipAnglesSerializeZ + 'i:' + str(i-1) + ';d:' + str(LHipAnglesNormaliseListZ[j+101*(i-1)]) + ';'
    LKneeAnglesSerializeX = LKneeAnglesSerializeX + 'i:' + str(i-1) + ';d:' + str(LKneeAnglesNormaliseListX[j+101*(i-1)]) + ';'
    LKneeAnglesSerializeY = LKneeAnglesSerializeY + 'i:' + str(i-1) + ';d:' + str(LKneeAnglesNormaliseListY[j+101*(i-1)]) + ';'
    LKneeAnglesSerializeZ = LKneeAnglesSerializeZ + 'i:' + str(i-1) + ';d:' + str(LKneeAnglesNormaliseListZ[j+101*(i-1)]) + ';'
    LAnkleAnglesSerializeX = LAnkleAnglesSerializeX + 'i:' + str(i-1) + ';d:' + str(LAnkleAnglesNormaliseListX[j+101*(i-1)]) + ';'
    LAnkleAnglesSerializeY = LAnkleAnglesSerializeY + 'i:' + str(i-1) + ';d:' + str(LAnkleAnglesNormaliseListY[j+101*(i-1)]) + ';'
    LAnkleAnglesSerializeZ = LAnkleAnglesSerializeZ + 'i:' + str(i-1) + ';d:' + str(LAnkleAnglesNormaliseListZ[j+101*(i-1)]) + ';'
    LFootProgressAnglesSerializeX = LFootProgressAnglesSerializeX + 'i:' + str(i-1) + ';d:' + str(LFootProgressAnglesNormaliseListX[j+101*(i-1)]) + ';'
    LFootProgressAnglesSerializeY = LFootProgressAnglesSerializeY + 'i:' + str(i-1) + ';d:' + str(LFootProgressAnglesNormaliseListY[j+101*(i-1)]) + ';'
    LFootProgressAnglesSerializeZ = LFootProgressAnglesSerializeZ + 'i:' + str(i-1) + ';d:' + str(LFootProgressAnglesNormaliseListZ[j+101*(i-1)]) + ';'

  LPelvisAnglesSerializeX = LPelvisAnglesSerializeX + '}'
  LPelvisAnglesSerializeY = LPelvisAnglesSerializeY + '}'
  LPelvisAnglesSerializeZ = LPelvisAnglesSerializeZ + '}'
  LHipAnglesSerializeX = LHipAnglesSerializeX + '}'
  LHipAnglesSerializeY = LHipAnglesSerializeY + '}'
  LHipAnglesSerializeZ = LHipAnglesSerializeZ + '}'
  LKneeAnglesSerializeX = LKneeAnglesSerializeX + '}'
  LKneeAnglesSerializeY = LKneeAnglesSerializeY + '}'
  LKneeAnglesSerializeZ = LKneeAnglesSerializeZ + '}'
  LAnkleAnglesSerializeX = LAnkleAnglesSerializeX + '}'
  LAnkleAnglesSerializeY = LAnkleAnglesSerializeY + '}'
  LAnkleAnglesSerializeZ = LAnkleAnglesSerializeZ + '}'
  LFootProgressAnglesSerializeX = LFootProgressAnglesSerializeX + '}'
  LFootProgressAnglesSerializeY = LFootProgressAnglesSerializeY + '}'
  LFootProgressAnglesSerializeZ = LFootProgressAnglesSerializeZ + '}'

LPelvisAnglesSerializeX = LPelvisAnglesSerializeX + '}'
LPelvisAnglesSerializeY = LPelvisAnglesSerializeY + '}'
LPelvisAnglesSerializeZ = LPelvisAnglesSerializeZ + '}'
LHipAnglesSerializeX = LHipAnglesSerializeX + '}'
LHipAnglesSerializeY = LHipAnglesSerializeY + '}'
LHipAnglesSerializeZ = LHipAnglesSerializeZ + '}'
LKneeAnglesSerializeX = LKneeAnglesSerializeX + '}'
LKneeAnglesSerializeY = LKneeAnglesSerializeY + '}'
LKneeAnglesSerializeZ = LKneeAnglesSerializeZ + '}'
LAnkleAnglesSerializeX = LAnkleAnglesSerializeX + '}'
LAnkleAnglesSerializeY = LAnkleAnglesSerializeY + '}'
LAnkleAnglesSerializeZ = LAnkleAnglesSerializeZ + '}'
LFootProgressAnglesSerializeX = LFootProgressAnglesSerializeX + '}'
LFootProgressAnglesSerializeY = LFootProgressAnglesSerializeY + '}'
LFootProgressAnglesSerializeZ = LFootProgressAnglesSerializeZ + '}'




nb_cycle_droit = RPelvisAnglesNormaliseListX.size / 101
RPelvisAnglesSerializeX = 'a:101:{'
RPelvisAnglesSerializeY = 'a:101:{'
RPelvisAnglesSerializeZ = 'a:101:{'
RHipAnglesSerializeX = 'a:101:{'
RHipAnglesSerializeY = 'a:101:{'
RHipAnglesSerializeZ = 'a:101:{'
RKneeAnglesSerializeX = 'a:101:{'
RKneeAnglesSerializeY = 'a:101:{'
RKneeAnglesSerializeZ = 'a:101:{'
RAnkleAnglesSerializeX = 'a:101:{'
RAnkleAnglesSerializeY = 'a:101:{'
RAnkleAnglesSerializeZ = 'a:101:{'
RFootProgressAnglesSerializeX = 'a:101:{'
RFootProgressAnglesSerializeY = 'a:101:{'
RFootProgressAnglesSerializeZ = 'a:101:{'

for j in range(0,101):
  RPelvisAnglesSerializeX = RPelvisAnglesSerializeX + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RPelvisAnglesSerializeY = RPelvisAnglesSerializeY + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RPelvisAnglesSerializeZ = RPelvisAnglesSerializeZ + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RHipAnglesSerializeX = RHipAnglesSerializeX + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RHipAnglesSerializeY = RHipAnglesSerializeY + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RHipAnglesSerializeZ = RHipAnglesSerializeZ + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RKneeAnglesSerializeX = RKneeAnglesSerializeX + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RKneeAnglesSerializeY = RKneeAnglesSerializeY + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RKneeAnglesSerializeZ = RKneeAnglesSerializeZ + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RAnkleAnglesSerializeX = RAnkleAnglesSerializeX + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RAnkleAnglesSerializeY = RAnkleAnglesSerializeY + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RAnkleAnglesSerializeZ = RAnkleAnglesSerializeZ + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RFootProgressAnglesSerializeX = RFootProgressAnglesSerializeX + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RFootProgressAnglesSerializeY = RFootProgressAnglesSerializeY + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'
  RFootProgressAnglesSerializeZ = RFootProgressAnglesSerializeZ + 'i:' + str(j) + ';a:' + str(nb_cycle_droit) + ':{'

  for i in range(1,nb_cycle_droit+1):
    RPelvisAnglesSerializeX = RPelvisAnglesSerializeX + 'i:' + str(i-1) + ';d:' + str(RPelvisAnglesNormaliseListX[j+101*(i-1)]) + ';'
    RPelvisAnglesSerializeY = RPelvisAnglesSerializeY + 'i:' + str(i-1) + ';d:' + str(RPelvisAnglesNormaliseListY[j+101*(i-1)]) + ';'
    RPelvisAnglesSerializeZ = RPelvisAnglesSerializeZ + 'i:' + str(i-1) + ';d:' + str(RPelvisAnglesNormaliseListZ[j+101*(i-1)]) + ';'
    RHipAnglesSerializeX = RHipAnglesSerializeX + 'i:' + str(i-1) + ';d:' + str(RHipAnglesNormaliseListX[j+101*(i-1)]) + ';'
    RHipAnglesSerializeY = RHipAnglesSerializeY + 'i:' + str(i-1) + ';d:' + str(RHipAnglesNormaliseListY[j+101*(i-1)]) + ';'
    RHipAnglesSerializeZ = RHipAnglesSerializeZ + 'i:' + str(i-1) + ';d:' + str(RHipAnglesNormaliseListZ[j+101*(i-1)]) + ';'
    RKneeAnglesSerializeX = RKneeAnglesSerializeX + 'i:' + str(i-1) + ';d:' + str(RKneeAnglesNormaliseListX[j+101*(i-1)]) + ';'
    RKneeAnglesSerializeY = RKneeAnglesSerializeY + 'i:' + str(i-1) + ';d:' + str(RKneeAnglesNormaliseListY[j+101*(i-1)]) + ';'
    RKneeAnglesSerializeZ = RKneeAnglesSerializeZ + 'i:' + str(i-1) + ';d:' + str(RKneeAnglesNormaliseListZ[j+101*(i-1)]) + ';'
    RAnkleAnglesSerializeX = RAnkleAnglesSerializeX + 'i:' + str(i-1) + ';d:' + str(RAnkleAnglesNormaliseListX[j+101*(i-1)]) + ';'
    RAnkleAnglesSerializeY = RAnkleAnglesSerializeY + 'i:' + str(i-1) + ';d:' + str(RAnkleAnglesNormaliseListY[j+101*(i-1)]) + ';'
    RAnkleAnglesSerializeZ = RAnkleAnglesSerializeZ + 'i:' + str(i-1) + ';d:' + str(RAnkleAnglesNormaliseListZ[j+101*(i-1)]) + ';'
    RFootProgressAnglesSerializeX = RFootProgressAnglesSerializeX + 'i:' + str(i-1) + ';d:' + str(RFootProgressAnglesNormaliseListX[j+101*(i-1)]) + ';'
    RFootProgressAnglesSerializeY = RFootProgressAnglesSerializeY + 'i:' + str(i-1) + ';d:' + str(RFootProgressAnglesNormaliseListY[j+101*(i-1)]) + ';'
    RFootProgressAnglesSerializeZ = RFootProgressAnglesSerializeZ + 'i:' + str(i-1) + ';d:' + str(RFootProgressAnglesNormaliseListZ[j+101*(i-1)]) + ';'

  RPelvisAnglesSerializeX = RPelvisAnglesSerializeX + '}'
  RPelvisAnglesSerializeY = RPelvisAnglesSerializeY + '}'
  RPelvisAnglesSerializeZ = RPelvisAnglesSerializeZ + '}'
  RHipAnglesSerializeX = RHipAnglesSerializeX + '}'
  RHipAnglesSerializeY = RHipAnglesSerializeY + '}'
  RHipAnglesSerializeZ = RHipAnglesSerializeZ + '}'
  RKneeAnglesSerializeX = RKneeAnglesSerializeX + '}'
  RKneeAnglesSerializeY = RKneeAnglesSerializeY + '}'
  RKneeAnglesSerializeZ = RKneeAnglesSerializeZ + '}'
  RAnkleAnglesSerializeX = RAnkleAnglesSerializeX + '}'
  RAnkleAnglesSerializeY = RAnkleAnglesSerializeY + '}'
  RAnkleAnglesSerializeZ = RAnkleAnglesSerializeZ + '}'
  RFootProgressAnglesSerializeX = RFootProgressAnglesSerializeX + '}'
  RFootProgressAnglesSerializeY = RFootProgressAnglesSerializeY + '}'
  RFootProgressAnglesSerializeZ = RFootProgressAnglesSerializeZ + '}'

RPelvisAnglesSerializeX = RPelvisAnglesSerializeX + '}'
RPelvisAnglesSerializeY = RPelvisAnglesSerializeY + '}'
RPelvisAnglesSerializeZ = RPelvisAnglesSerializeZ + '}'
RHipAnglesSerializeX = RHipAnglesSerializeX + '}'
RHipAnglesSerializeY = RHipAnglesSerializeY + '}'
RHipAnglesSerializeZ = RHipAnglesSerializeZ + '}'
RKneeAnglesSerializeX = RKneeAnglesSerializeX + '}'
RKneeAnglesSerializeY = RKneeAnglesSerializeY + '}'
RKneeAnglesSerializeZ = RKneeAnglesSerializeZ + '}'
RAnkleAnglesSerializeX = RAnkleAnglesSerializeX + '}'
RAnkleAnglesSerializeY = RAnkleAnglesSerializeY + '}'
RAnkleAnglesSerializeZ = RAnkleAnglesSerializeZ + '}'
RFootProgressAnglesSerializeX = RFootProgressAnglesSerializeX + '}'
RFootProgressAnglesSerializeY = RFootProgressAnglesSerializeY + '}'
RFootProgressAnglesSerializeZ = RFootProgressAnglesSerializeZ + '}'



for i in range(len(list)):	
  os.remove(list[i])

print(nb_cycle_gauche)
print(LPelvisAnglesSerializeX)
print(LPelvisAnglesSerializeY)
print(LPelvisAnglesSerializeZ)
print(LHipAnglesSerializeX)
print(LHipAnglesSerializeY)
print(LHipAnglesSerializeZ)
print(LKneeAnglesSerializeX)
print(LKneeAnglesSerializeY)
print(LKneeAnglesSerializeZ)
print(LAnkleAnglesSerializeX)
print(LAnkleAnglesSerializeY)
print(LAnkleAnglesSerializeZ)
print(LFootProgressAnglesSerializeX)
print(LFootProgressAnglesSerializeY)
print(LFootProgressAnglesSerializeZ)

print(nb_cycle_droit)
print(RPelvisAnglesSerializeX)
print(RPelvisAnglesSerializeY)
print(RPelvisAnglesSerializeZ)
print(RHipAnglesSerializeX)
print(RHipAnglesSerializeY)
print(RHipAnglesSerializeZ)
print(RKneeAnglesSerializeX)
print(RKneeAnglesSerializeY)
print(RKneeAnglesSerializeZ)
print(RAnkleAnglesSerializeX)
print(RAnkleAnglesSerializeY)
print(RAnkleAnglesSerializeZ)
print(RFootProgressAnglesSerializeX)
print(RFootProgressAnglesSerializeY)
print(RFootProgressAnglesSerializeZ)
